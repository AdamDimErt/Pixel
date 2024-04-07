@extends('app')
@section('content')
    @if(isset($orders) && count($orders) > 0)
        <h5 class="white-text page-presenter-header">Ваши заказы</h5>
        <div class="row">
            @foreach($orders as $order)
                <div class="col s12 order-wrapper">
                    <p class="white-text">{{__('translations.Order')}} <span class="orange-text"><u><a href="{{route('viewOrder', $order)}}">#{{$order->id}}</a></u></span></p>
                    <hr>
                    <p class="white-text">{{__('translations.Amount of goods')}}: <span class="orange-text">{{count($order->orderItems)}}</span></p>
                    <p class="white-text">{{__('translations.Order status')}}: <span class="orange-text">{{$order->status}}</span></p>
                    <p class="white-text">{{__('translations.Total sum')}}: <span class="orange-text">{{$order->amountPaid}} тг</span></p>
                </div>
            @endforeach
        </div>
    @else
        <h5 class="white-text page-presenter-header">{{__('translations.You do not have any orders yet')}}</h5>
    @endif
@endsection
