<?php

namespace App\Orchid\Screens\Order;

use App\Models\Item;
use App\Models\Order;
use App\Orchid\Layouts\Order\OrderListLayout;
use Illuminate\Http\Request;
use Orchid\Platform\Models\User;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class OrderListScreen extends Screen
{
    /**
     * Query data.
     */
    public function query(): array
    {
        return [
            'orders' => Order::filters()->defaultSort('id')->paginate(),
        ];
    }

    /**
     * The name is displayed on the user's screen and in the headers
     */
    public function name(): ?string
    {
        return 'Order';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
        return 'All orders';
    }

    /**
     * Button commands.
     *
     * @return Link[]
     */
    public function commandBar(): array
    {
        return [
            Link::make('Create new')
                ->icon('pencil')
                ->route('platform.orders.create'),
        ];
    }

    /**
     * Views.
     *
     * @return Layout[]
     */
    public function layout(): array
    {
        return [
            OrderListLayout::class,
        ];
    }

    public function cancel(Request $request): void
    {
        $order = Order::findOrFail($request->get('id'));
        $order->status = 'cancelled';
        $order->save();
        Toast::info(__('Order was cancelled'));
    }

    public function return(Request $request): void
    {
        $order = Order::findOrFail($request->get('id'));
        $order->status = 'returned';
        $order->save();

        $order->items()->each(function (Item $item) {
            $item->status = 'available';
            $item->save();
        });

        Toast::info(__('Order was returned'));
    }

    public function confirm(Request $request): void
    {
        $order = Order::findOrFail($request->get('id'));
        $order->status = 'in_rent';
        $order->save();
        Toast::info(__('Order was confirmed'));
    }
}
