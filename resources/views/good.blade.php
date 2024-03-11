@extends('app')
@section('content')
    <div class="row">
        @if(isset($goodType))
            <h5 class="white-text">{{$goodType->description}}</h5>
        @else
            <h5 class="white-text">Все товары</h5>
        @endif
        @if(count($goods) != 0)
            @foreach($goods as $good)
                <div class="col s12 m6 l3">
                    <div class="card hoverable z-depth-5">
                        <div class="card-image">
                            <img src="{{$good->attachment()?->first()?->url()}}" class="card-presenter-image">
                            @auth('clients')
                                <a class="btn-floating add-to-favorites-btn btn-large halfway-fab waves-effect waves-light orange darken-4">
                                    <i class="large material-icons">favorite_border</i>
                                </a>
                            @endauth
                            @guest('clients')
                                <a class="btn-floating add-to-favorites-btn btn-large halfway-fab waves-effect waves-light orange darken-4 modal-trigger"
                                   href="#auth-modal">
                                    <i class="large material-icons">favorite_border</i>
                                </a>
                            @endguest
                            <a class="btn-floating add-to-cart-btn btn-large halfway-fab waves-effect waves-light orange darken-4"
                               data-product-id="{{ $good->id }}">
                                <i class="large material-icons">add_shopping_cart</i>
                            </a>
                        </div>
                        <div class="card-content">
                                <span class="card-title">
                                    <b>{{$good->name}}</b>
                                </span>
                            <span class="cost-label">
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
            <h5>Тут пока ничего нет :(</h5>
        @endif
    </div>
    @push('scripts')
        <script src="{{asset('js/cart.js')}}"></script>
    @endpush
    @include('auth.modal', ['icon' => 'favorite_border', 'title' => 'Необходима аутентификация', 'content' => 'Для добавления товара в "любимые" необходимо аутентифицироваться'])
@endsection
