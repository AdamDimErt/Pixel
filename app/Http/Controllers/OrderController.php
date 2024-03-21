<?php

namespace App\Http\Controllers;

use App\Models\Additional;
use App\Models\Good;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderItem;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function confirmOrder()
    {
        return response(view('ordering.final'))->cookie('cart', '{}', 60 * 30 * 24);
    }

    public function settleOrder(Request $request)
    {
        $requestData = $request->all();

        $cartData = json_decode($request->cookie('cart', '{}'), true);

        $totalSum = 0;

        $orderItemData = [];
        foreach ($cartData as $itemKey => $itemValue) {
            $itemKeySeparated = explode('pixelrental', $itemKey);
            $goodId = $itemKeySeparated[0];
            $itemId = $itemKeySeparated[1];
            $good = Good::query()->find($goodId);
            $item = Item::query()->find($itemId);

            $requestParticularGood = $requestData[$itemKey];

            $dateObj1 = DateTime::createFromFormat('d/m/Y H:i', $requestParticularGood['rent_start_date'].' '.$requestParticularGood['start_time']);
            $dateObj2 = DateTime::createFromFormat('d/m/Y H:i', $requestParticularGood['rent_end_date'].' '.$requestParticularGood['end_time']);
            $interval = $dateObj1->diff($dateObj2);
            $diffInDays = $interval->days === 0 ? 1 : $interval->days;

            $goodCost = $diffInDays * ($good->discount_cost ?? $good->cost);

            foreach ($cartData[$itemKey] as $additionalId) {
                $additionalCost = Additional::query()->find($additionalId)->cost;

                $totalSum += $additionalCost * $diffInDays;
            }

            $orderItemData[] = [
                'item_id' => $itemId,
                'status' => 'waiting',
                'additionals' => json_encode(array_values($cartData[$itemKey])),
                'rent_start_date' => $dateObj1->format('Y-m-d'),
                'rent_start_time' => $dateObj1->format('H:i'),
                'rent_end_date' => $dateObj2->format('Y-m-d'),
                'rent_end_time' => $dateObj2->format('H:i'),
            ];

            $totalSum += $goodCost;

        }
        $order = Order::query()->create([
            'client_id' => Auth::guard('clients')->id(),
            'amount_paid' => $totalSum,
            'status' => 'waiting',
        ]);

        foreach ($orderItemData as $itemToCreate) {
            $itemToCreate['order_id'] = $order->id;

            OrderItem::query()->create($itemToCreate);
        }

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
