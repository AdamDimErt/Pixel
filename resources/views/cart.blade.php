@extends('app')
@section('content')
    @if (count($goodsInCart) > 0)
        <h5 class="white-text">Корзина <span class="grey-text">({{$goodsInCart->count()}} позиции)</span></h5>
        <p class="grey-text">Общее количество: {{$totalCount}}</p>
        <a href="#" class="btn waves-ripple clean-cart-btn waves-orange waves-effect orange darken-4"><i class="material-icons">delete_forever</i>
            Очистить корзину</a>
        <div class="row">
            <div class="col s12 m9 goods-list">
                @foreach($goodsInCart as $good)
                    <hr>
                    <div class="row no-margin">
                        <div class="col s12 m3 good-cart-image">
                            <img src="{{$good->attachment()?->first()?->url}}" alt="" width="200px" class="">
                        </div>
                        <div class="col s12 m9 good-cart-additional-info white-text">
                            <p>Наменование: <b class="orange-text text-darken-4"><u>{{$good->name}}</u></b></p>
                            <p>Цена (за сутки): <b>{{$good->cost}}</b></p>
                            <p>Цена за поломку во время аренды: <b>{{$good->damage_cost}}</b></p>
                            <p>Описание: <b class="truncate">{{$good->description}}</b></p>
                            <p>Количество: <b></b></p>
                            <hr>
                            <div class="control-sum">
                                <h5 class="inline">Итог: {{$good->cookie_count * $good->cost}} / сутки</h5>
                                <div class="control-buttons valign-wrapper">
                                    <button class="substract-btn inline-button btn btn-floating waves-effect waves-orange orange white-text darken-4"><i class="material-icons">exposure_neg_1</i></button>
                                    <span class="cart-view-counter">{{$good->cookie_count}}</span>
                                    <button class="add-btn inline-button btn btn-floating waves-effect waves-orange orange white-text darken-4"><i class="material-icons">exposure_plus_1</i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col s12 m3 additional-info white-text">
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
                <a href="#" class="btn orange darken-4 auth-link valign-wrapper next-step-btn">
                    Продолжить к шагу 2 <i class="material-icons">keyboard_arrow_right</i>
                </a>
            </div>
        </div>
        @auth('clients')
            <div class="row">
                <div class="col s12 m9">
                    <div class="row">
                        <div class="col s12 input-field">
                            <input name="rent_start_date" type="text" class="datepicker white-text">
                            <label for="rent_start_date">Дата начала аренды: </label>
                        </div>
                        <div class="col s12 input-field">
                            <input name="rent_start_time" type="text" class="timepicker white-text">
                            <label for="rent_start_time">Время начала аренды: </label>
                        </div>
                        <div class="col s12">
                            <input name="rent_end_date" type="text" class="datepicker white-text">
                            <label for="rent_end_date">Дата конца аренды:</label>
                        </div>
                        <div class="col s12">
                            <input name="rent_end_time" type="text" class="timepicker white-text">
                            <label for="rent_end_time">Время конца аренды:</label>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="col s12 m3 additional-info white-text">
                    <span class="grey-text">Шаг 2 из 3</span>
                    <p>Укажите дату и время начала аренды, и окончания аренды оборудования</p>
                    <hr>
                    <p><b>ВАЖНО!</b></p>
                    <p>Примите к сведению: За просрочку выплаты платежей, указанных в договоре, Арендодатель в праве
                        требовать от Арендатора выплатить пеню в размере 5 % от не выплаченного платежа за каждый день
                        просрочки</p>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m9">
                    <div class="row">
                        <div class="col s12 input-field">
                            <input name="rent_start_date" type="text" class="datepicker white-text">
                            <label for="rent_start_date">Дата начала аренды: </label>
                        </div>
                        <div class="col s12">
                            <input name="rent_end_date" type="text" class="datepicker white-text">
                            <label for="rent_end_date"></label>
                        </div>
                    </div>
                </div>
                <div class="col s12 m3 additional-info white-text">
                    <span class="grey-text">Шаг 3 из 3</span>
                    <p>Укажите дату и время начала аренды, и окончания аренды оборудования</p>
                    <hr>
                    <p><b>ВАЖНО!</b></p>
                    <p>Примите к сведению: За просрочку выплаты платежей, указанных в договоре, Арендодатель в праве
                        требовать от Арендатора выплатить пеню в размере 5 % от не выплаченного платежа за каждый день
                        просрочки</p>
                </div>
            </div>
        @endauth
        @guest('clients')
            <div class="col s12 right-align">
                <a href="#" class="btn orange darken-4 auth-link ">
                    Войти
                </a>
                <a href="#" class="btn grey darken-4 white-text register-link">
                    Зарегистрироваться
                </a>
            </div>
        @endguest
    @else
        <h4 class="white-text center">Тут пока ничего нет :(</h4>
        <h5 class="white-text center">Возвращайтесь на <a href="/" class="orange-text"><b><u>главную</u></b></a>, и
            добавьте в корзину что-нибудь, что вам приглянётся</h5>
    @endif
@endsection
