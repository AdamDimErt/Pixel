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
        $idCounts = $this->countDistinctKeys($cartData);
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

        return redirect(route('confirmOrder'));
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
}
