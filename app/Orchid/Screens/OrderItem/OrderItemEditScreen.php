<?php

namespace App\Orchid\Screens\OrderItem;

use App\Models\Additional;
use App\Models\Item;
use App\Models\OrderItem;
use DateTime;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Alert;
use Orchid\Support\Facades\Layout;

class OrderItemEditScreen extends Screen
{
    /**
     * @var OrderItem
     */
    public $orderItem;

    /**
     * Query data.
     */
    public function query(OrderItem $orderItem): array
    {
        return [
            'orderItem' => $orderItem,
        ];
    }

    /**
     * The name is displayed on the user's screen and in the headers
     */
    public function name(): ?string
    {
        return $this->orderItem->exists ? 'Edit orderItem' : 'Creating a new orderItem';
    }

    /**
     * The description is displayed on the user's screen under the heading
     */
    public function description(): ?string
    {
        return __('translations.OrderItems');
    }

    public function commandBar(): array
    {
        return [
            Button::make(__('translations.Create'))
                ->icon('pencil')
                ->method('createOrUpdate')
                ->canSee(! $this->orderItem->exists),

            Button::make(__('translations.Update'))
                ->icon('note')
                ->method('createOrUpdate')
                ->canSee($this->orderItem->exists),

            Button::make(__('translations.Delete'))
                ->icon('trash')
                ->method('remove')
                ->canSee($this->orderItem->exists),
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
            Layout::rows([

                Relation::make('orderItem.item_id')
                    ->fromModel(Item::class, 'id')
                    ->displayAppend('name')
                    ->help(__('translations.Name'))
                    ->title('Choose a item for that order'),

                Relation::make('orderItem.additionals')
                    ->fromModel(Additional::class, 'name')
                    ->multiple()
                    ->title('Choose a category for that good'),

                Select::make('orderItem.status')
                    ->options([
                        'returned'=>'Returned',
                        'in_rent'=>'In rent',
                        'waiting'=>'Waiting',
                        'confirmed'=>'Confirmed',
                        'cancelled'=>'Cancelled'
                    ])
                    ->title('status')
                    ->help(__('translations.Name')),

                DateTimer::make('orderItem.rent_start_date')
                    ->title('Opening date')
                    ->format('Y-m-d'),

                Select::make('orderItem.rent_start_time')
                    ->options($this->generateTimeSpans())
                    ->title('status')
                    ->help(__('translations.Name')),

                DateTimer::make('orderItem.rent_end_date')
                    ->title('Opening date')
                    ->format('Y-m-d'),

                Select::make('orderItem.rent_end_time')
                    ->options($this->generateTimeSpans())
                    ->title('status')
                    ->help(__('translations.Name')),
            ]),
        ];
    }

    /**
     * @return RedirectResponse
     */
    public function createOrUpdate(OrderItem $orderItem, Request $request)
    {
        $orderItem->fill($request->input('orderItem'));

        if (! $request->input('orderItem.additionals')) {
            $orderItem->additionals = '[]';
        }

        $totalAmount = 0;

        $dateObj1 = DateTime::createFromFormat('Y-m-d H:i:s', $orderItem->rent_start_date.' '.$orderItem->rent_start_time);
        $dateObj2 = DateTime::createFromFormat('Y-m-d H:i:s', $orderItem->rent_end_date.' '.$orderItem->rent_end_time);
        $interval = $dateObj1->diff($dateObj2);
        $diffInDays = $interval->days === 0 ? 1 : $interval->days;

        $orderItem->amount_of_days = $diffInDays;

        $totalAmount += $orderItem->item->good->discount_cost ?? $orderItem->item->good->cost;

        $totalAmount *= $diffInDays;

        foreach ($orderItem->getAdditionals() as $additional) {
            $totalAmount += $additional->cost * $diffInDays;
        }

        $orderItem->amount_paid = $totalAmount;

        $orderItem->save();

        Alert::info('You have successfully created a orderItem.');

        return redirect()->route('platform.orderItems.list');
    }

    /**
     * @return RedirectResponse
     *
     * @throws \Exception
     */
    public function remove(OrderItem $orderItem)
    {
        $orderItem->delete();

        Alert::info('You have successfully deleted the orderItem.');

        return redirect()->route('platform.orderItems.list');
    }

    public function generateTimeSpans()
    {
        $arr = [];
        for ($hours = 0; $hours < 24; $hours++) {
            for ($minutes = 0; $minutes < 60; $minutes += 5) {
                $hoursStr = str_pad($hours, 2, '0', STR_PAD_LEFT);
                $minutesStr = str_pad($minutes, 2, '0', STR_PAD_LEFT);

                $arr["$hoursStr:$minutesStr:00"] = "$hoursStr:$minutesStr:00";
            }
        }

        return $arr;
    }
}
