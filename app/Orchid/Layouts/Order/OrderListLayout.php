<?php

namespace App\Orchid\Layouts\Order;

use App\Models\Good;
use App\Models\GoodType;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Components\Cells\DateTimeSplit;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Support\Facades\Alert;

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
            TD::make('Owner')
                ->filter(
                    Relation::make()
                        ->fromModel(User::class, 'name')
                )
                ->render(function (Order $order) {
                    return Link::make($order->owner->name)
                        ->route('platform.systems.users.edit', $order->owner);
                }),

            TD::make('status')
                ->sort()
                ->filter(
                    Select::make('status')
                        ->options([
                            'In rent' => 'in_rent',
                            'Returned' => 'returned',
                            'Canceled' => 'canceled',
                            'Waiting' => 'waiting',
                        ])
                        ->title('status')
                        ->help('status itema')
                )
                ->render(function (Order $order) {
                    return $order->status;
                }),

            TD::make('rent_start', __('Created'))
                ->usingComponent(DateTimeSplit::class)
                ->align(TD::ALIGN_RIGHT)
                ->defaultHidden()
                ->sort(),

            TD::make('rent_end', __('Created'))
                ->usingComponent(DateTimeSplit::class)
                ->align(TD::ALIGN_RIGHT)
                ->defaultHidden()
                ->sort(),

            TD::make('created_at', __('Created'))
                ->usingComponent(DateTimeSplit::class)
                ->align(TD::ALIGN_RIGHT)
                ->defaultHidden()
                ->sort(),

            TD::make('updated_at', __('Created'))
                ->usingComponent(DateTimeSplit::class)
                ->align(TD::ALIGN_RIGHT)
                ->defaultHidden()
                ->sort(),

            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (\App\Models\Order $order) {
                    $btnsList = [
                        Link::make(__('Look at items'))
                            ->route('platform.items.list',
                                [
                                    'filter[id]' => $order
                                        ->items()
                                        ->pluck('items.id')
                                        ->implode(',')
                                ]
                            )
                            ->icon('bs.search')
                    ];

                    if ($order->status === 'in_rent'){
                        $btnsList[] = Button::make(__('Return'))
                            ->icon('bs.arrow-return-left')
                            ->confirm(__('If you return this order, you will not be available to use it again'))
                            ->method('return', [
                                'id' => $order->id,
                            ]);
                    }

                    if ($order->status === 'waiting'){
                        $btnsList[] = Link::make(__('Edit'))
                            ->route('platform.orders.edit', $order->id)
                            ->icon('bs.pencil');
                        $btnsList[] = Button::make(__('Confirm'))
                            ->icon('bs.check2')
                            ->confirm(__('Would you like to confirm this order?'))
                            ->method('confirm', [
                                'id' => $order->id,
                            ]);
                        $btnsList[] = Button::make(__('Cancel'))
                            ->icon('bs.x')
                            ->confirm(__('If you cancel this order, you will not be available to use it again'))
                            ->method('cancel', [
                                'id' => $order->id,
                            ]);
                    }

                    return DropDown::make()
                        ->icon('bs.three-dots-vertical')
                        ->list($btnsList);
                }
                ),
        ];
    }

    /**
     * @param Order $order
     *
     * @return RedirectResponse
     */
    public function remove(Order $order)
    {
        $order->delete();

        Alert::info('You have successfully deleted the orders.');

        return redirect()->route('platform.orders.list');
    }
}
