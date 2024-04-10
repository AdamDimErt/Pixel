<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Good;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request): JsonResponse
    {
        $goodId = $request->input('product_id');
        $additionalIds = $request->input('additional_ids', []);
        $cartData = json_decode($request->cookie('cart', '{}'), true);
        $idCounts = $this->countDistinctKeys($cartData);
        $good = Good::query()->find($goodId);

        if (! isset($idCounts[$goodId]) || $idCounts[$goodId] < count($good->items()->get())) {
            $itemId = $good->items()->offset($idCounts[$goodId] ?? 0)->first()->id;
            $cartData[$goodId.'pixelrental'.$itemId] = $additionalIds;

            return response()
                ->json(['success' => true])
                ->cookie('cart', json_encode($cartData), 60 * 24 * 30);
        }

        return response()->json(['error' => 'На данный момент такой товар имеется в количестве: '.
            count(Good::query()->find($goodId)->items)], 400);
    }

    public function removeFromCart(Request $request): JsonResponse
    {
        $cartData = json_decode($request->cookie('cart', '{}'), true);
        $goodIdToRemove = $request->input('product_id');
        unset($cartData[$goodIdToRemove]);

        return response()
            ->json(['success' => true])
            ->cookie('cart', json_encode($cartData), 60 * 24 * 30);
    }

    public function getCartCount(Request $request): JsonResponse
    {
        $cartData = json_decode($request->cookie('cart', '{}'), true);
        $cartCount = count($cartData);

        return response()->json(['cartCount' => $cartCount]);
    }

    public function cleanupCart(): JsonResponse
    {
        return response()->json(['success' => true])
            ->cookie('cart', json_encode([]), 60 * 24 * 30);
    }

    public function cart(Request $request): \Illuminate\Contracts\Foundation\Application|Factory|View|Application
    {
        $cartData = json_decode($request->cookie('cart', '{}'), true);

        if (Auth::guard('clients')->id()){
            $client = Client::query()->find(Auth::guard('clients')->id())->toArray();
        } else {
            $client = null;
        }

        $idCounts = $this->countDistinctKeys($cartData);
        $keys = [];
        foreach ($cartData as $subArray) {
            $keys = array_merge($keys, array_keys($subArray));
        }

        $distinctKeys = [];

        foreach ($cartData as $key => $value) {
            $distinctKeys[] = explode('pixelrental', $key)[0];
        }

        $goodsInCart = Good::query()->whereIn('id', $distinctKeys)
            ->with(['attachment'])
            ->get();

        $items = [];
        $totalCount = 0;
        $goodsInCart->map(function ($good) use (&$totalCount, $idCounts, &$items, &$cartData) {
            $goodId = $good->id;
            $count = $idCounts[$goodId] ?? 0;
            $good->cookie_count = $count;
            $totalCount += $count;
            foreach ($good->items()->take($idCounts[$good->id])->get() as $item) {
                $item->totalCost = $this->countCostWithAdditionals($item, $cartData);
                $items[] = $item;
            }

            return $good;
        });

        return view('cart', compact('goodsInCart', 'totalCount', 'items', 'cartData', 'client'));
    }

    public function countDistinctKeys($array)
    {
        $counts = [];
        foreach ($array as $key => $value) {
            $goodId = explode('pixelrental', $key)[0];
            $counts[$goodId] = 0;
            foreach ($array as $subArrayKey => $subArrayValue) {
                if (explode('pixelrental', $subArrayKey)[0] === $goodId) {
                    $counts[$goodId] += 1;
                }
            }
        }

        return $counts;
    }

    public function additionalAdd(Request $request)
    {
        $cartData = json_decode($request->cookie('cart', '{}'), true);

        $cartKey = $request->input('cart_key');
        $additionalId = $request->input('additional_id', []);

        if (array_key_exists($cartKey, $cartData)) {
            $cartData[$cartKey][] = $additionalId;
        }

        return response()
            ->json(['success' => true])
            ->cookie('cart', json_encode($cartData), 60 * 24 * 30);
    }

    public function additionalRemove(Request $request)
    {
        $cartData = json_decode($request->cookie('cart', '{}'), true);

        $cartKey = $request->input('cart_key');
        $additionalId = $request->input('additional_id', []);

        if (array_key_exists($cartKey, $cartData)) {
            unset($cartData[$cartKey][array_search($additionalId, $cartData[$cartKey])]);
        }

        return response()
            ->json(['success' => true])
            ->cookie('cart', json_encode($cartData), 60 * 24 * 30);
    }

    public function countCostWithAdditionals($item, $cartData)
    {
        $cost = $item->good->discount_cost ?? $item->good->cost;
        foreach ($item->good->getAdditionals() as $additional) {
            if (in_array($additional->id, $cartData[$item->good->id.'pixelrental'.$item->id])) {
                $cost += $additional->cost;
            }
        }

        return $cost;
    }
}
