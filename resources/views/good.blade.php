@extends('app')
@section('content')
    <div class="container">
        <div class="row">
            <h4 class="white-text">{{$goodTypeDesc}}</h4>
            @if(count($goods) != 0)
                @foreach($goods as $good)
                    <div class="col s12 m6 l3">
                        <div class="card hoverable z-depth-5">
                            <div class="card-image">
                                <img src="{{$good->attachment()?->first()?->url()}}" class="card-presenter-image">
                                @auth()
                                    <a class="btn-floating add-to-favorites-btn btn-large halfway-fab waves-effect waves-light orange darken-4">
                                        <i class="large material-icons">favorite_border</i>
                                    </a>
                                @endauth
                                @guest()
                                    <a class="btn-floating add-to-favorites-btn btn-large halfway-fab waves-effect waves-light orange darken-4 modal-trigger" href="#auth-modal">
                                        <i class="large material-icons">favorite_border</i>
                                    </a>
                                @endguest
                                    <a class="btn-floating add-to-cart-btn btn-large halfway-fab waves-effect waves-light orange darken-4" data-product-id="{{ $good->id }}">
                                        <i class="large material-icons">add_shopping_cart</i>
                                    </a>
                            </div>
                            <div class="card-content">
                                <span class="card-title">
                                    <b>{{$good->name}}</b>
                                </span>
                                <span class="right">
                                    <span class="chip">
                                        <b>{{$good->cost}}</b>
                                    </span>
                                    тг/сутки
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <h2>К сожалению, ничего не найдено :(</h2>
            @endif
        </div>
    </div>
    <div id="auth-modal" class="modal">
        <div class="modal-content container">
            <h1 class="btn-floating btn-large orange darken-4"><i class="large material-icons text-accent-4 white-text ">favorite_border</i></h1>
            <h4>Войдите в аккаунт</h4>
            <p>Для того, чтобы добавить товар в избранное, войдите в аккаунт</p>
        </div>
        <div class="modal-footer">
            <div class="row">
                <div class="col s12 center">
                    <a href="#!" class="btn-large modal-btn main-color">Войти</a>
                </div>
                <div class="col s12 center">
                    <a href="#!" class="btn-large modal-btn grey">Зарегистрироваться</a>
                </div>
            </div>
        </div>
    </div>
@endsection
