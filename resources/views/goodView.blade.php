@extends('app')
@section('content')
    <h4 class="white-text">{{$good->name}}</h4>
    <div class="row">
        <div class="col s12 m6">
            <img class="materialboxed good-image z-depth-5" width="100%"
                 src="{{$good->attachment()?->first()?->url()}}">
        </div>
        <div class="col s12 m6 detailed-info white-text">
            <div class="detailed-info-wrapper">
                <h4 class="center no-margin">{{$good->name}}</h4>
                <span class="flow-text">Описание:</span>
                @if(count(explode('-', $good->description)) > 0)
                    @foreach(explode('-', $good->description) as $desc)
                        <li>{{$desc}}</li>
                    @endforeach
                @else
                    <p>{{$good->desc}}</p>
                @endif
                @if($good->discount_cost)
                    <span class="right">
                        <span class="chip small item-cost-holder">
                            <s>{{$good->cost}}</s>
                        </span>
                    <span class="chip red white-text large item-cost-holder">
                        <u>{{$good->discount_cost}}</u>
                    </span>
                тг/сутки
                </span>
                @else
                    <span class="right">
                        <span class="chip item-cost-holder">
                            {{$good->cost}}
                        </span>
                    тг/сутки
                    </span>
                @endif
            </div>
            <div class="info-btns-wrapper">
                @if(count($good->getAdditionals()) > 0)
                    <h5>В дополнение к комплекту берут: </h5>
                    @foreach($good->getAdditionals() as $additional)
                        <p>
                            <label>
                                <input type="checkbox" class="orange-text additional-checkbox"
                                       data-additional-id="{{$additional->id}}"/>
                                <span>{{$additional->name}} <span class="white-text">(+ {{$additional->cost}}тг)</span></span>
                            </label>
                        </p>
                    @endforeach
                @endif
            </div>
            <hr>
            <p class="grey-text text-darken-2">Стоимость при повреждении:
                    {{$good->damage_cost}}
                тг
            </p>
        </div>
        <div class="col s12">
            <hr>
            <div class="row view-btns-holder">
                <div class="col s6 center">
                    <a class="btn-large orange darken-4 auth-link confirm-order-btn no-margin add-to-cart-btn"
                       data-product-id="{{ $good->id }}">
                        <span class="hide-on-med-and-down good-view-action-btn">В корзину</span>
                        <i class="material-icons">add_shopping_cart</i>
                    </a>
                </div>
                <div class="col s6 center">
                    @auth('clients')
                        @if (in_array($good->id, App\Models\Client::query()->find(Auth::guard('clients')->id())->favorites()->pluck('good_id')->toArray()))
                            <a class="btn-large orange remove-from-favorites-btn darken-4 auth-link confirm-order-btn no-margin"
                               data-product-id="{{$good->id}}">
                                <span class="hide-on-med-and-down good-view-action-btn">Удалить из любимого</span>
                                <i class="material-icons">
                                    favorite
                                </i>
                            </a>
                        @else
                            <a class="btn-large orange add-to-favorites-btn darken-4 auth-link confirm-order-btn no-margin"
                               data-product-id="{{$good->id}}">
                                <span class="hide-on-med-and-down good-view-action-btn">В любимое</span>
                                <i class="large material-icons">
                                    favorite_border
                                </i>
                            </a>
                        @endif
                    @endauth
                    @guest('clients')
                        <a href="#auth-modal"
                           class="btn-large orange darken-4 auth-link confirm-order-btn no-margin modal-trigger">
                            <span class="hide-on-med-and-down good-view-action-btn">В любимое</span>
                            <i class="material-icons">
                                favorite_border
                            </i>
                        </a>
                    @endguest
                </div>
            </div>
        </div>
    </div>
    @if(count($good->getRelatedGoods()) > 0)
        <h4 class="white-text">Похожие товары:</h4>
        <div class="carousel">
            @foreach($good->getRelatedGoods() as $relatedGood)
                <div class="carousel-item">
                    @include('goodCard', ['good' => $relatedGood])
                </div>
            @endforeach
        </div>
    @endif

    @include('auth.modal', ['icon' => 'favorite_border', 'title' => 'Необходима аутентификация', 'content' => 'Для добавления товара в "любимые" необходимо аутентифицироваться'])
    @push('scripts')
        <script src="{{asset('js/cart.js')}}"></script>
        <script src="{{asset('js/favoriteActions.js')}}"></script>
    @endpush
@endsection
