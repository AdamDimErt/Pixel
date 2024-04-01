<?php

namespace App\Orchid\Layouts\OrderItem;

use App\Models\Order;
use App\Models\OrderItem;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Components\Cells\DateTimeSplit;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\NumberRange;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class OrderItemListLayout extends Table
{
    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the table.
     *
     * @var string
     */
    protected $target = 'orderItems';

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
                ->render(function (OrderItem $orderItemItem) {
                    return Link::make($orderItemItem->item->name)
                        ->route('platform.orderItems.edit', $orderItemItem);
                }),

            TD::make('status')
                ->sort()
                ->filter(
                    Select::make('status')
                        ->options([
                            'returned'=>'Returned',
                            'in_rent'=>'In rent',
                            'waiting'=>'Waiting',
                            'confirmed'=>'Confirmed',
                            'cancelled'=>'Cancelled'
                        ])
                        ->title('status')
                        ->help(__('translations.Name'))
                )
                ->render(function (OrderItem $orderItemItem) {
                    return $orderItemItem->status;
                }),

            TD::make('amount_paid')
                ->sort()
                ->filter(
                    Input::make()
                ),

            TD::make('rent_start_date', __('Rent start date'))
                ->align(TD::ALIGN_RIGHT)
                ->sort(),

            TD::make('rent_start_time', __('Rent start time'))
                ->align(TD::ALIGN_RIGHT)
                ->sort(),

            TD::make('rent_end_date', __('Rent start date'))
                ->align(TD::ALIGN_RIGHT)
                ->sort(),

            TD::make('rent_end_time', __('Rent end time'))
                ->align(TD::ALIGN_RIGHT)
                ->sort(),

            TD::make('created_at', __('Created'))
                ->usingComponent(DateTimeSplit::class)
                ->align(TD::ALIGN_RIGHT)
                ->defaultHidden()
                ->sort(),

            TD::make('updated_at', __('translations.Last edit'))
                ->usingComponent(DateTimeSplit::class)
                ->align(TD::ALIGN_RIGHT)
                ->defaultHidden()
                ->sort(),

            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(function (\App\Models\OrderItem $orderItem) {
                    $btnsList = [Link::make(__('Edit'))
                        ->route('platform.orderItems.edit', $orderItem->id)
                        ->icon('bs.pencil')];

                    if ($orderItem->status === 'in_rent') {
                        $btnsList[] = Button::make(__('Return'))
                            ->icon('bs.arrow-return-left')
                            ->confirm(__('If you return this order, you will not be available to use it again'))
                            ->method('return', [
                                'id' => $orderItem->id,
                            ]);
                    }

                    if ($orderItem->status === 'waiting') {

                        $btnsList[] = Button::make(__('Confirm'))
                            ->icon('bs.check2')
                            ->confirm(__('Would you like to confirm this order?'))
                            ->method('confirm', [
                                'id' => $orderItem->id,
                            ]);
                        $btnsList[] = Button::make(__('Cancel'))
                            ->icon('bs.x')
                            ->confirm(__('If you cancel this order, you will not be available to use it again'))
                            ->method('cancel', [
                                'id' => $orderItem->id,
                            ]);
                    }

                    return DropDown::make()
                        ->icon('bs.three-dots-vertical')
                        ->list($btnsList);
                })
        ];
    }
}
