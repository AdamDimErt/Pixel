@extends('app')
@section('content')
    <input type="hidden" name="" id="order-id-holder" value="{{$order->id}}">
    <h5 class="white-text page-presenter-header">Заказ <span class="orange-text">#{{$order->id}}</span></h5>
    <div class="row">
        <div class="col s12 order-view-wrapper z-depth-5">
            @if(count($order->orderItems) > 0)
                <h5 class="white-text">
                    Ваш заказ состоит из следующих товаров:
                </h5>
                @foreach($order->orderItems as $index => $item)
                    <div class="order-item-wrapper z-depth-5">
                        <div class="row">
                            <div class="col s12 m9">
                                <p class="white-text">{{$index + 1}}. Наименование товара: <span class="orange-text">{{$item->item->good->name}}</span></p>
                                <p class="white-text">Цена товара: <span class="orange-text">{{$item->item->good->discount_cost ?? $item->item->good->cost}}</span></p>
                                <p class="white-text">Статус: <span class="orange-text">{{$item->status}}</span></p>
                                <p class="white-text">Категория товара: <a href="{{route('goodList', $item->item->good->goodType->code)}}" class="orange-text">{{$item->item->good->goodType->name}}</a></p>
                                <p class="white-text">Время начала аренды: <span class="orange-text">{{$item->rent_start_date}} {{$item->rent_start_time}}</span></p>
                                <p class="white-text">Время конца аренды: <span class="orange-text">{{$item->rent_end_date}} {{$item->rent_end_time}}</span></p>
                                @if (count(json_decode($item->additionals)) > 0)
                                    <p class="white-text">Дополнительные товары:</p>
                                    <ul>
                                        @foreach(\App\Models\Additional::query()->whereIn('id', json_decode($item->additionals))->get() as $additional)
                                            <li class="white-text">{{$additional->name}} <span class="grey-text"> (+{{$additional->cost * $item->amount_of_days}} тг)</span></li>
                                        @endforeach
                                    </ul>
                                @endif
                                <p class="white-text">Общее количество дней: <span class="orange-text">{{$item->amount_of_days}}</span></p>
                                <hr>
                                <h5 class="white-text">Сумма к оплате: <span class="orange-text">{{$item->amount_paid}}</span></h5>
                            </div>
                            <div class="col s12 m3 center">
                                <a href="{{route('viewGood', $item->item->good)}}">
                                    <img src="{{$item->item->good->attachment->first()->url}}" alt="" class="order-item-image-wrapper z-depth-5">
                                </a>
                                @if ((new DateTime())->format('Y-m-d H:i:s') < (new DateTime($item->rent_start_date . ' ' .$item->rent_start_time))->format('Y-m-d H:i:s') && $order->status === 'waiting')
                                    <a href="#order-canceling-modal" class="large-btn btn orange darken-4 white-text cancel-order-btn modal-trigger">Отменить заказ</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        @include('confirmModal', [
            'modalClass' => 'order-canceling-modal',
            'title' => 'Вы действительно хотите отменить заказ?',
            'subTitle' => null,
            'link' => null,
            'linkCaption' => null,
            'downTitle' => 'После отмены данный заказ не будет более доступен',
            'btnAction' => 'cancelOrder',
            'btnCaption' => 'Отменить заказ',
        ])
    </div>
    @push('scripts')
        <script src="{{asset('js/orderActions.js')}}"></script>
    @endpush
@endsection
