@extends('app')
@section('content')
    @if ($goodsInCart)
        <h5 class="white-text">Корзина <span class="grey-text">{{$goodsInCart->count()}} товаров</span></h5>
        <a href="#" class="btn waves-ripple waves-orange waves-effect orange darken-4"><i class="material-icons">delete_forever</i>
            Очистить корзину</a>
        <div class="row">
            <div class="col s12 m9 goods-list">
                @foreach($goodsInCart as $good)
                    <div class="row">
                        <div class="col s3 good-cart-image">
                            <img src="{{$good->attachment()?->first()?->url}}" alt="" width="200px">
                        </div>
                        <div class="col s9 good-cart-additional-info white-text">
                            <p>Наменование: <b><u>{{$good->name}}</u></b></p>
                            <p>Цена (за сутки): <b>{{$good->cost}}</b></p>
                            <p>Цена за поломку во время аренды: <b>{{$good->damage_cost}}</b></p>
                            <p>Описание: <b class="truncate">{{$good->description}}</b></p>
                        </div>
                    </div>
                    <hr>
                @endforeach
            </div>
            <div class="col s12 m3 additional-info white-text">
                <span class="grey-text">Шаг 1 из 2</span>
                <p>Тут перечислены все товары, которые вы добавляли к себе в корзину.</p>
                <hr>
                <p><b>ВАЖНО!</b></p>
                <p>Обязательно имейте в виду, что при аренде оборудования и его поломке, следует дополнительная оплата,
                    исходя из условий договора</p>
            </div>
        </div>
        @auth('clients')
            <div class="row">
                <div class="col s12 m9">
                    <div class="row">
                        <div class="col s12 input-field">
                            <input name="rent_start_date" type="text" class="datepicker">
                            <label for="rent_start_date">Дата начала аренды: </label>
                        </div>
                        <div class="col s12">
                            <input name="rent_start_date" type="text" class="datepicker">
                            <label for="rent_start_date"></label>
                        </div>
                    </div>
                </div>
                <div class="col s12 m3 additional-info white-text">
                    <span class="grey-text">Шаг 2 из 2</span>
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
        <h5>Тут пока ничего нет :(</h5>
    @endif
@endsection
