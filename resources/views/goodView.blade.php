@extends('app')
@section('content')
    <h4 class="white-text">{{$good->name}}</h4>
    <div class="row">
        <div class="col s12 m6">
            <img class="materialboxed good-image z-depth-5" width="100%" src="{{$good->attachment()?->first()?->url()}}">
        </div>
        <div class="col s12 m6 detailed-info white-text">
            <div class="detailed-info-wrapper">
                <h4 class="center no-margin">{{$good->name}}</h4>
                <span class="flow-text">Описание:</span>
                @foreach(explode('-', $good->description) as $desc)
                    <li>{{$desc}}</li>
                @endforeach
                <span class="item-cost-view">
                                    <span class="chip">
                                        <b>{{$good->cost}}</b>
                                    </span>
                                    тг/сутки
                                </span>
                <p class="flow-text">Стоимость при повреждении:
                    <span class="orange-text">
                        <u>{{$good->damage_cost}}</u>
                    </span>
                    тг
                </p>
            </div>
            <div class="info-btns-wrapper">
                <h5>В дополнение к комплекту берут: </h5>
                {{--        TODO        --}}
                <form action="">
                    <input type="checkbox" name="" id="">
                </form>
                <div class="row">
                    <div class="col s6">
                        <a class="btn-large orange darken-4 auth-link confirm-order-btn no-margin add-to-cart-btn"
                                data-product-id="{{ $good->id }}">
                            В корзину
                            <i class="material-icons">add_shopping_cart</i>
                        </a>
                    </div>
                    <div class="col s6">
                        @auth('clients')
                            <a class="btn-large orange darken-4 auth-link confirm-order-btn no-margin">
                                В любимое
                                <i class="material-icons">
                                    favorite_border
                                </i>
                            </a>
                        @endauth
                        @guest('clients')
                            <a href="#auth-modal" class="btn-large orange darken-4 auth-link confirm-order-btn no-margin modal-trigger">
                                В любимое
                                <i class="material-icons">
                                    favorite_border
                                </i>
                            </a>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>
    <h4 class="white-text">Похожие товары:</h4>
    <div class="carousel">
        @foreach($good->getRelatedGoods() as $relatedGood)
            <div class="carousel-item">
                @include('goodCard', ['good' => $relatedGood])
            </div>
        @endforeach
    </div>
    @include('auth.modal', ['icon' => 'favorite_border', 'title' => 'Необходима аутентификация', 'content' => 'Для добавления товара в "любимые" необходимо аутентифицироваться'])
    @push('scripts')
        <script src="{{asset('js/cart.js')}}"></script>
    @endpush
@endsection
