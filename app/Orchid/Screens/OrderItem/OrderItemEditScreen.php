<?php

namespace App\Orchid\Screens\OrderItem;

use App\Models\Item;
use App\Models\Order;
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
        return $this->orderItem->exists ? __('translations.Edit orderItem') : __('translations.Creating a new orderItem');
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

    public function layout(): array
    {
        $itemOptions = Item::all()->pluck('name', 'id')->toArray();

        return [

            Layout::rows([

                Select::make('orderItem.item_id')
                    ->options(
                        $itemOptions
                    )
                    ->help(__('translations.OrderItem item help'))
                    ->required()
                    ->title(__('translations.Item')),

                Relation::make('orderItem.order_id')
                    ->fromModel(Order::class, 'id')
                    ->required()
                    ->help(__('translations.OrderItem order help'))
                    ->title(__('translations.Order')),

                Select::make('orderItem.status')
                    ->options([
                        null => __('translations.not chosen'),
                        'returned' => __('translations.returned'),
                        'in_rent' => __('translations.in_rent'),
                        'waiting' => __('translations.waiting'),
                        'confirmed' => __('translations.confirmed'),
                        'cancelled' => __('translations.cancelled'),
                    ])
                    ->title(__('translations.Status'))
                    ->required()
                    ->help(__('translations.OrderItem status help')),

                Select::make('orderItem.is_additional')
                    ->options([
                        true => 'Да',
                        false => 'Нет',
                    ])
                    ->title(__('translations.Is additional'))
                    ->required()
                    ->help(__('translations.OrderItem is_additional help')),

                DateTimer::make('orderItem.rent_start_date')
                    ->title(__('translations.Rent start date'))
                    ->placeholder(__('translations.OrderItem rent_start help'))
                    ->required()
                    ->help(__('translations.OrderItem rent_start help'))
                    ->format('Y-m-d'),

                Select::make('orderItem.rent_start_time')
                    ->options($this->generateTimeSpans())
                    ->required()
                    ->title(__('translations.Rent start time'))
                    ->help(__('translations.OrderItem rent_start_time help')),

                DateTimer::make('orderItem.rent_end_date')
                    ->title(__('translations.Rent end date'))
                    ->required()
                    ->placeholder(__('translations.OrderItem rent_end help'))
                    ->help(__('translations.OrderItem rent_end help'))
                    ->format('Y-m-d'),

                Select::make('orderItem.rent_end_time')
                    ->options($this->generateTimeSpans())
                    ->required()
                    ->title(__('translations.Rent end time'))
                    ->help(__('translations.OrderItem rent_end_time help')),
            ]),
        ];
    }

    /**
     * @return RedirectResponse
     */
    public function createOrUpdate(OrderItem $orderItem, Request $request)
    {
        $orderId = $request->input('orderItem')['order_id'];

        $item = Item::find($request->input('orderItem')['item_id']);

        $order = Order::query()->find($orderId);

        $client = $order->owner;

        $orderItem->fill($request->input('orderItem'));
        $dateObj1 = DateTime::createFromFormat('Y-m-d H:i:s', $request->all()['orderItem']['rent_start_date'].' '.$request->all()['orderItem']['rent_start_time']);
        $dateObj2 = DateTime::createFromFormat('Y-m-d H:i:s', $request->all()['orderItem']['rent_end_date'].' '.$request->all()['orderItem']['rent_end_time']);

        $diffInSeconds = $dateObj2->getTimestamp() - $dateObj1->getTimestamp();

        $diffInDays = ceil($diffInSeconds / (60 * 60 * 24));

        $diffInDays = max(1, $diffInDays);

        $orderItem->amount_of_days = $diffInDays;

        if (! $request->input('orderItem.additionals')) {
            $orderItem->additionals = '[]';
        }

        $totalAmount = 0;


        $totalAmount += $item->good->discount_cost ?? $item->good->cost;

        $totalAmount *= $diffInDays;

        if (count($orderItem->getAdditionals()) != 0) {
            foreach ($orderItem->getAdditionals() as $additional) {
                $totalAmount += ($additional->good->additional_cost ?? $additional->good->cost) * $diffInDays;
            }
        }

        $totalAmount = $totalAmount / 100 * (100 - $client->discount);

        $orderItem->amount_paid = $totalAmount;

        $orderItem->save();

        $order->amount_paid = $order->amount_paid + $totalAmount;

        $order->save();

        Alert::info('You have successfully created a orderItem.');

        return redirect()->back();
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
