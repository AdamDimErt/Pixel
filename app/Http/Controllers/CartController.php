<?php

namespace App\Http\Controllers;

use App\Models\Good;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request): JsonResponse
    {
        $goodId = $request->input('product_id');

        $cartData = json_decode($request->cookie('cart', '{}'), true);
        $cartData[] = $goodId;
        return response()
            ->json(['success' => true])
            ->cookie('cart', json_encode($cartData), 60 * 24 * 30);
    }

    public function removeFromCart(Request $request): JsonResponse
    {
        $cartData = json_decode($request->cookie('cart', '{}'), true);
        $goodIdToRemove = $request->input('product_id');
        $index = array_search($goodIdToRemove, $cartData);
        if ($index !== false) {
            array_splice($cartData, $index, 1);
        }
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

    public function cleanupCart(Request $request): JsonResponse
    {
        $cartData = json_decode($request->cookie('cart', '{}'), true);
        $cartCount = count($cartData);

        return response()->json(['cartCount' => $cartCount]);
    }

    public function cart(Request $request): \Illuminate\Contracts\Foundation\Application|Factory|View|Application
    {
        $cartData = json_decode($request->cookie('cart', '{}'), true);
        $idCounts = array_count_values($cartData);
        $goodsInCart = Good::query()->whereIn('id', $cartData)
            ->with(['attachment'])
            ->get();
        $totalCount = 0;
        $goodsInCart->map(function ($good) use (&$totalCount, $idCounts) {
            $goodId = $good->id;
            $count = $idCounts[$goodId] ?? 0;
            $good->cookie_count = $count;
            $totalCount += $count;
            return $good;
        });
        return view('cart', compact('goodsInCart', 'totalCount'));
    }
}
