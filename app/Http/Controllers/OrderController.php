<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Good;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Wanted;
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
        $client = Client::query()->find(Auth::guard('clients')->id());

        $wanted = Wanted::query()
            ->orWhere('iin', '=', $client->iin)
            ->first();

        if ($wanted) {
            Auth::guard('clients')->logout();

            return redirect()->back()->withErrors(['authentication' => 'Профиль был заблокирован']);
        }

        $requestData = $request->all();

        if ($request->cookie('cart', '{}') === '{}'){
            return redirect()->back()->withErrors(['cart' => 'Пожалуйста, выберите товары и оформите по ним заказ']);
        }

        $cartData = json_decode($request->cookie('cart', '{}'), true);

        $totalSum = 0;

        $orderItemMessageData = '';

        $orderItemData = [];
        foreach ($cartData as $itemKey => $itemValue) {
            $itemKeySeparated = explode('pixelrental', $itemKey);
            $goodId = $itemKeySeparated[0];
            $itemId = $itemKeySeparated[1];
            $good = Good::query()->find($goodId);

            $requestParticularGood = $requestData[$itemKey];

            $dateObj1 = DateTime::createFromFormat('d/m/Y H:i', $requestParticularGood['rent_start_date'] . ' ' . $requestParticularGood['start_time']);
            $dateObj2 = DateTime::createFromFormat('d/m/Y H:i', $requestParticularGood['rent_end_date'] . ' ' . $requestParticularGood['end_time']);
            $interval = $dateObj1->diff($dateObj2);
            $diffInDays = $interval->days + 1;

            $orderItemMessageData = $orderItemMessageData . 'Товар: ' . $good->name_ru . '
';

            if ($good->discount_cost) {
                $orderItemMessageData = $orderItemMessageData . 'Цена: ' . $good->discount_cost . '(скидка)
';
            } else {
                $orderItemMessageData = $orderItemMessageData . 'Цена: ' . $good->cost . '
';
            }

            $orderItemMessageData = $orderItemMessageData . 'Дата начала аренды: *' . $dateObj1->format('d/m/Y H:i') . '*
';
            $orderItemMessageData = $orderItemMessageData . 'Дата конца аренды: *' . $dateObj2->format('d/m/Y H:i') . '*
';
            $orderItemMessageData = $orderItemMessageData . 'Количество дней: *' . $diffInDays . '*
';
            $currentItemCost = $diffInDays * ($good->discount_cost ?? $good->cost);
            $orderItemMessageData = $orderItemMessageData . 'Общая сумма за товар: *' . $currentItemCost . '*
';
            $orderItemMessageData = $orderItemMessageData . 'Дополнения к товару:
';

            foreach ($cartData[$itemKey] as $additionalId) {
                $additional = Item::query()->find($additionalId)->load('good');

                $orderItemMessageData = $orderItemMessageData . '   Наименование: ' . $additional->good->name_ru . '
';
                $orderItemMessageData = $orderItemMessageData . '       Цена: ' . (($additional->good->additional_cost !== null && $additional->good->additional_cost > 0) ? $additional->good->additional_cost : $additional->good->cost) . '
';
                $additionalCost = (($additional->good->additional_cost !== null && $additional->good->additional_cost > 0) ? $additional->good->additional_cost : $additional->good->cost) * $diffInDays;

                $totalSum += $additionalCost;

                $orderItemData[] = [
                    'item_id' => $additionalId,
                    'status' => 'waiting',
                    'amount_of_days' => $diffInDays,
                    'is_additional' => true,
                    'amount_paid' => $additionalCost / 100 * (100 - $client->discount),
                    'rent_start_date' => $dateObj1->format('Y-m-d'),
                    'rent_start_time' => $dateObj1->format('H:i'),
                    'rent_end_date' => $dateObj2->format('Y-m-d'),
                    'rent_end_time' => $dateObj2->format('H:i'),
                ];
            }

            $orderItemData[] = [
                'item_id' => $itemId,
                'status' => 'waiting',
                'amount_of_days' => $diffInDays,
                'is_additional' => false,
                'additionals' => json_encode($cartData[$itemKey]),
                'amount_paid' => $currentItemCost,
                'rent_start_date' => $dateObj1->format('Y-m-d'),
                'rent_start_time' => $dateObj1->format('H:i'),
                'rent_end_date' => $dateObj2->format('Y-m-d'),
                'rent_end_time' => $dateObj2->format('H:i'),
            ];

            $totalSum += $currentItemCost;

        }

        if ($client->discount) {
            $totalSum = $totalSum / 100 * (100 - $client->discount);
        }
        $order = Order::query()->create([
            'client_id' => $client->id,
            'amount_paid' => $totalSum,
            'status' => 'waiting',
        ]);

        foreach ($orderItemData as $itemToCreate) {
            $itemToCreate['order_id'] = $order->id;

            OrderItem::query()->create($itemToCreate);
        }

        $aggreementFile = makeOrderAgreement($order->fresh(['orderItems', 'owner']));

        $order->attachment()->syncWithoutDetaching($aggreementFile->id);
        $order->agreement_id = $order->id;

        $order->save();

        $aggreementUrl = $aggreementFile->url();

        $response = sendTelegramMessage(
            "*НОВЫЙ ЗАКАЗ* $order->id
Покупатель: [$client->phone](https://wa.me/$client->phone)
Имя: $client->name
Электронный адрес: $client->email
Ссылка на договор: $aggreementUrl
ИИН: $client->iin
Инстаграм: [$client->instagram](https://www.instagram.com/$client->instagram/)
Скидка: $client->discount процентов
Общая сумма: $totalSum тг

Список товаров:
" . $orderItemMessageData);

        if (!$response->ok()) {
            sendTelegramMessage(
                "*НОВЫЙ ЗАКАЗ* $order->id
Покупатель: [$client->phone](https://wa.me/$client->phone)
Имя: $client->name
Электронный адрес: $client->email
Ссылка на договор: $aggreementUrl
ИИН: $client->iin
Инстаграм: [$client->instagram](https://www.instagram.com/$client->instagram/)
Скидка: $client->discount процентов
Общая сумма: $totalSum тг

Список товаров слишком большой для отображения в боте.");
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
