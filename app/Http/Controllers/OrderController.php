<?php

namespace App\Http\Controllers;

use App\Models\Good;
use App\Models\Item;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redirect;

class OrderController extends Controller
{
    public function preOrder(Request $request)
    {
        $cartData = json_decode($request->cookie('cart', '{}'), true);
        $idCounts = array_count_values($cartData);
        $goodsInCart = Good::query()->whereIn('id', $cartData)
            ->with(['attachment'])
            ->get();
        $totalCount = 0;
        $totalPrice = 0;
        $errors = [];
        foreach ($goodsInCart as $good) {
            $goodId = $good->id;
            $count = $idCounts[$goodId] ?? 0;
            if ($count > count($good->availableItems())) {
                $errors[$good->name] = 'На данный момент такой товар имеется в количестве: '.count($good->availableItems());
            }
        }
        if (count($errors) > 0) {
            return Redirect::back()->withErrors($errors);
        }
        $goodsInCart->map(function ($good) use (&$totalCount, &$totalPrice, $idCounts) {
            $goodId = $good->id;
            $count = $idCounts[$goodId] ?? 0;
            $good->cookie_count = $count;
            $totalCount += $count;
            $good->total_price = $good->cost * $count;
            $totalPrice += $good->total_price;

            return $good;
        });

        return view('ordering.2nd_step', compact('totalPrice', 'totalCount'));
    }

    public function settleOrder(Request $request)
    {
        $cartData = json_decode($request->cookie('cart', '{}'), true);
        $idCounts = array_count_values($cartData);
        $goodsInCart = Good::query()->whereIn('id', $cartData)
            ->with(['attachment'])
            ->get();
        $totalPrice = 0;
        $itemsToAttach = [];

        foreach ($goodsInCart as $good) {
            $goodId = $good->id;
            $count = $idCounts[$goodId] ?? 0;
            foreach ($good->availableItems()->take($count)->pluck('id')->toArray() as $itemId) {
                $itemsToAttach[] = $itemId;
            }
        }

        $rentStartDate = Carbon::createFromFormat('d/m/Y', $request->input('start_date'));
        $rentEndDate = Carbon::createFromFormat('d/m/Y', $request->input('end_date'));

        $order = Order::query()->create([
            'client_id' => Auth::guard('clients')->id(),
            'amount_paid' => $totalPrice,
            'status' => 'waiting',
            'rent_start' => $rentStartDate,
            'rent_end' => $rentEndDate,
        ]);

        $order->items()->sync($itemsToAttach);

        foreach ($itemsToAttach as $itemId) {
            $item = Item::query()->find($itemId);
            $item->status = 'pre-ordered';
            $item->save();
        }

        return redirect(route('confirmOrder'));
    }

    public function confirmOrder(Request $request)
    {
        $cookie = Cookie::forget('cart');

        return response()->view('ordering.final')->withCookie($cookie);
    }
}
