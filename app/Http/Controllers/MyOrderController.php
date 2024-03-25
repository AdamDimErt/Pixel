<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MyOrderController extends Controller
{
    public function getMyOrders(Request $request)
    {
        $orders = Order::query()->where('client_id', '=', Auth::guard('clients')->id())->with('orderItems')->get();

        return view('orderList', compact('orders'));
    }

    public function viewOrder(Request $request, Order $order)
    {
        $order->load('orderItems.item.good.goodType');

        return view('orderView', compact('order'));
    }

    public function cancelOrder(Request $request, Order $order)
    {
        DB::beginTransaction();
        try {
            $order->status = 'cancelled';
            $order->save();

            $order->orderItems()->update(['status' => 'cancelled']);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();

            return response()
                ->json(['success' => false,
                    'message' => 'Не удалось отменить заказ']);
        }

        return response()
            ->json(['success' => true]);
    }
}
