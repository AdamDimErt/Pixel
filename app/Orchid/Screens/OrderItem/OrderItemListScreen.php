<?php

namespace App\Orchid\Screens\OrderItem;

use App\Models\Item;
use App\Models\Order;
use App\Models\OrderItem;
use App\Orchid\Layouts\OrderItem\OrderItemListLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class OrderItemListScreen extends Screen
{
    /**
     * Query data.
     */
    public function query(): array
    {
        return [
            'orderItems' => OrderItem::filters()->defaultSort('id')->paginate(),
        ];
    }

    /**
     * The name is displayed on the user's screen and in the headers
     */
    public function name(): ?string
    {
        return 'OrderItem';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
        return 'All orderItems';
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
                ->route('platform.orderItems.create'),
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
            OrderItemListLayout::class,
        ];
    }

    public function cancel(Request $request): void
    {
        $orderItem = OrderItem::findOrFail($request->get('id'));
        $orderItem->status = 'cancelled';
        $orderItem->save();
        Toast::info(__('OrderItem was cancelled'));
    }

    public function return(Request $request): void
    {
        $orderItem = OrderItem::findOrFail($request->get('id'));
        $orderItem->status = 'returned';
        $orderItem->save();

        Toast::info(__('OrderItem was returned'));
    }

    public function confirm(Request $request): void
    {
        $orderItem = OrderItem::findOrFail($request->get('id'));
        $orderItem->status = 'in_rent';
        $orderItem->save();
        Toast::info(__('OrderItem was confirmed'));
    }
}
