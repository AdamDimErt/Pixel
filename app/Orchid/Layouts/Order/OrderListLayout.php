<?php

namespace App\Orchid\Layouts\Order;

use App\Models\Order;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class OrderListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'orders';

    /**
     * Get the table cells to be displayed.
     *
     * @return TD[]
     */
    protected function columns(): iterable
    {
        return [
            TD::make('name')
                ->sort()
                ->filter(
                    Input::make()
                )
                ->render(function (Order $order) {
                    return Link::make($order->good->name)
                        ->route('platform.orders.edit', $order);
                }),

            TD::make('status')
                ->sort()
                ->filter(
                    Select::make('status')
                        ->options([
                            'Available' => 'available',
                            'Rented' => 'rented',
                        ])
                        ->title('status')
                        ->help('status itema')
                )
                ->render(function (Order $order) {
                    return $order->status;
                }),

            TD::make('created_at', 'Created')
                ->sort(),

            TD::make('updated_at', 'Last edit')
                ->sort(),
        ];
    }
}
