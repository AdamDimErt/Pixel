@extends('app')
@section('content')
    @if(isset($orders) && count($orders) > 0)
        <h5 class="white-text page-presenter-header">Ваши заказы</h5>
        <div class="row">
            @foreach($orders as $order)
                <div class="col s12 order-wrapper">
                    <p class="white-text">Заказ <span class="orange-text"><u><a href="{{route('viewOrder', $order)}}">#{{$order->id}}</a></u></span></p>
                    <hr>
                    <p class="white-text">Количество товаров: <span class="orange-text">{{count($order->orderItems)}}</span></p>
                    <p class="white-text">Статус заказа: <span class="orange-text">{{$order->status}}</span></p>
                    <p class="white-text">Общая сумма: <span class="orange-text">{{$order->amount_paid}} тг</span></p>
                </div>
            @endforeach
        </div>
    @else
        <h5 class="white-text page-presenter-header">У вас пока нет заказов</h5>
    @endif
@endsection
