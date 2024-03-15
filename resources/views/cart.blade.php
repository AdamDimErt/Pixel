@extends('app')
@section('content')
    @if (count($goodsInCart) > 0)
        <h5 class="white-text">Корзина <span class="grey-text">({{$goodsInCart->count()}} уникальных товаров)</span></h5>
        <p class="grey-text">Общее количество: {{$totalCount}}</p>
{{--        <a href="#" class="btn waves-ripple clean-cart-btn waves-orange waves-effect orange darken-4 valign-wrapper">--}}
{{--            <i class="material-icons">delete_forever</i>--}}
{{--            Очистить корзину--}}
{{--        </a>--}}
        <div class="row">
            <div class="col s12 m3 additional-info white-text hide-on-med-and-up">
                <span class="grey-text"><u>Выберите промежутки аренды для товаров</u></span>
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
                @foreach($items as $item)
                    <div class="row no-margin good-wrapper">
                        <a href="#" class="cancel-btn"
                            data-product-id="{{$item->good->id . 'pixelrental' . $item->id}}">
                            <i class="material-icons white-text ">clear</i>
                        </a>
                        <hr>
                        <div class="col s12 m3 good-cart-image">
                            <img src="{{$item->good->attachment()?->first()?->url}}" alt="" width="200px" class="">
                        </div>
                        <div class="col s12 m9 good-cart-additional-info white-text">
                            <p>Наименование: <a href="/{{$item->good->id}}"><b class="orange-text text-darken-4"><u>{{$item->good->name}}</u></b></a></p>
                            @if($item->good->discount_cost && $item->good->discount_cost != 0)
                                <p>Цена (за сутки): <s>{{$item->good->cost}}</s> <b class="orange-text text-darken-4">{{$item->good->discount_cost}}</b></p>
                            @else
                                <p>Цена (за сутки): <b>{{$item->good->cost}}</b></p>
                            @endif
                            <p>Цена за поломку во время аренды: <b>{{$item->good->damage_cost}}</b></p>
                            <p>Описание: <b class="truncate">{{$item->good->description}}</b></p>
                            @if(count($item->good->getAdditionals()) > 0)
                                <p><u>Доп. аксессуары: </u></p>
                                @foreach($item->good->getAdditionals() as $additional)
                                    <p>
                                        <label>
                                            <input type="checkbox" class="orange-text additional-checkbox"
                                                   data-additional-id="{{$additional->id}}" @if(in_array($additional->id, $cartData[$item->good->id . 'pixelrental' .$item->id])) checked @endif/>
                                            <span>{{$additional->name}} <span class="white-text">(+ {{$additional->cost}}тг)</span></span>
                                        </label>
                                    </p>
                                @endforeach
                            @endif
                            <hr>
                            <div class="control-sum right">
                                <h5 class="inline">Итог:
                                    @if($item->good->discount_cost && $item->good->discount_cost != 0)
                                        <span
                                            class="good-cost-holder orange-text text-darken-4">{{$item->good->discount_cost}}
                                        </span>
                                        / сутки
                                    @else
                                        <span
                                            class="good-cost-holder">{{$item->good->cost}}
                                        </span>
                                        / сутки
                                    @endif
                                </h5>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="col s12 m3 additional-info white-text hide-on-med-and-down">
                <span class="grey-text"><u>Выберите промежутки аренды для товаров</u></span>
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
        <script src="{{asset('js/cartActions.js')}}"></script>
    @endpush
@endsection
