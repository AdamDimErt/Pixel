@extends('app')
@section('content')
    @if (count($goodsInCart) > 0)
        <h5 class="white-text">Корзина <span class="grey-text">({{$goodsInCart->count()}} позиции)</span></h5>
        <p class="grey-text">Общее количество: {{$totalCount}}</p>
        <a href="#" class="btn waves-ripple clean-cart-btn waves-orange waves-effect orange darken-4 valign-wrapper">
            <i class="material-icons">delete_forever</i>
            Очистить корзину
        </a>
        <div class="row">
            <div class="col s12 m3 additional-info white-text hide-on-med-and-up">
                <span class="grey-text">Шаг 1 из 3</span>
                <p>Тут перечислены все товары, которые вы добавляли к себе в корзину.</p>
                <p>Проверьте каждый из них на соответствие, и, в случае надобности, уберите ненужные.</p>
                <p>Если вдруг, вы захотите добавить что-то ещё, не стесняйтесь переходить на <a
                        class="orange-text text-darken-4" href="/"><b><u>главную</u></b></a>.</p>
                <hr>
                <p><b>ВАЖНО!</b></p>
                <p>Обязательно имейте в виду, что при аренде оборудования и его поломке, следует дополнительная оплата,
                    исходя из условий договора</p>
                <hr>
            </div>
            <div class="col s12 m9 goods-list">
                @foreach($goodsInCart as $good)
                    <div class="row no-margin">
                        <hr>
                        <div class="col s12 m3 good-cart-image">
                            <img src="{{$good->attachment()?->first()?->url}}" alt="" width="200px" class="">
                        </div>
                        <div class="col s12 m9 good-cart-additional-info white-text">
                            <p>Наменование: <b class="orange-text text-darken-4"><u>{{$good->name}}</u></b></p>
                            <p>Цена (за сутки): <b>{{$good->cost}}</b></p>
                            <p>Цена за поломку во время аренды: <b>{{$good->damage_cost}}</b></p>
                            <p>Описание: <b class="truncate">{{$good->description}}</b></p>
                            @if(count($good->availableItems()) < $good->cookie_count && !$errors->has($good->name))
                                <p class="red-text">{{ 'На данный момент такой товар имеется в количестве: '.count($good->availableItems()) }}</p>
                            @endif
                            @if ($errors->has($good->name))
                                <p class="red-text">{{ $errors->first($good->name) }}</p>
                            @endif
                            <hr>
                            <div class="control-sum">
                                <h5 class="inline">Итог: <span class="good-cost-holder">{{$good->cookie_count * $good->cost}}</span> / сутки</h5>
                                <div class="control-buttons valign-wrapper">
                                    <button
                                        class="substract-btn inline-button btn btn-floating waves-effect waves-orange orange white-text darken-4"
                                        data-product-id="{{ $good->id }}"
                                        data-product-cost="{{ $good->cost }}"
                                    >
                                        <i class="material-icons">exposure_neg_1</i></button>
                                    @if(count($good->availableItems()) < $good->cookie_count && !$errors->has($good->name))
                                        <span class="cart-view-counter red-text">{{$good->cookie_count}}</span>
                                    @else
                                        <span class="cart-view-counter">{{$good->cookie_count}}</span>
                                    @endif
                                    <button
                                        class="add-btn inline-button btn btn-floating waves-effect waves-orange orange white-text darken-4"
                                        data-product-id="{{ $good->id }}"
                                        data-product-cost="{{ $good->cost }}"
                                    >
                                        <i class="material-icons">exposure_plus_1</i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col s12 m3 additional-info white-text hide-on-med-and-down">
                <span class="grey-text">Шаг 1 из 3</span>
                <p>Тут перечислены все товары, которые вы добавляли к себе в корзину.</p>
                <p>Проверьте каждый из них на соответствие, и, в случае надобности, уберите ненужные.</p>
                <p>Если вдруг, вы захотите добавить что-то ещё, не стесняйтесь переходить на <a
                        class="orange-text text-darken-4" href="/"><b><u>главную</u></b></a>.</p>
                <hr>
                <p><b>ВАЖНО!</b></p>
                <p>Обязательно имейте в виду, что при аренде оборудования и его поломке, следует дополнительная оплата,
                    исходя из условий договора</p>
                <hr>
            </div>
        </div>
        @auth('clients')
            <div class="col s12 right-align">
                <a href="{{route('preOrder')}}" class="btn orange darken-4 auth-link valign-wrapper next-step-btn">
                    Продолжить к шагу 2 <i class="material-icons">keyboard_arrow_right</i>
                </a>
                @include('auth.modal', ['icon' => 'favorite_border', 'title' => "Необходима авторизация", 'content' => "Пожалуйста, войдите в аккаунт для продолжения оформления заказа"])
            </div>
        @endauth
        @guest('clients')
            <div class="col s12 right-align">
                <a href="#auth-modal" class="btn orange darken-4 auth-link valign-wrapper next-step-btn modal-trigger">
                    Продолжить к шагу 2 <i class="material-icons">keyboard_arrow_right</i>
                </a>
                @include('auth.modal', ['icon' => 'favorite_border', 'title' => "Необходима авторизация", 'content' => "Пожалуйста, войдите в аккаунт для продолжения оформления заказа"])
            </div>
        @endguest
    @else
        <h4 class="white-text center">Тут пока ничего нет :(</h4>
        <h5 class="white-text center">Возвращайтесь на <a href="/" class="orange-text"><b><u>главную</u></b></a>, и
            добавьте в корзину что-нибудь, что вам приглянётся</h5>
    @endif
    @push('scripts')
        <script src="{{asset('js/cartAmount.js')}}"></script>
    @endpush
@endsection
