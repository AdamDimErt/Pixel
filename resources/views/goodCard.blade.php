<a href="/{{$good->id}}">
    <div class="card hoverable z-depth-5">
        <div class="card-image">
            <img src="{{$good->attachment()?->first()?->url()}}" class="card-presenter-image">
            @if($good->discount_cost)
                <a class="btn-floating discount-btn halfway-fab waves-effect waves-light red darken-4">
                    <i class="medium material-icons white-text">money_off</i>
                </a>
            @endif
            @auth('clients')
                @if (in_array($good->id, App\Models\Client::query()->find(Auth::guard('clients')->id())->favorites()->pluck('good_id')->toArray()))
                    <a class="btn-floating remove-from-favorites-btn btn-large halfway-fab waves-effect waves-light orange darken-4" data-product-id="{{$good->id}}">
                        <i class="large material-icons">
                            favorite
                        </i>
                    </a>
                @else
                    <a class="btn-floating add-to-favorites-btn btn-large halfway-fab waves-effect waves-light orange darken-4" data-product-id="{{$good->id}}">
                        <i class="large material-icons">
                            favorite_border
                        </i>
                    </a>
                @endif
            @endauth
            @guest('clients')
                <a class="btn-floating add-to-favorites-btn btn-large halfway-fab waves-effect waves-light orange darken-4 modal-trigger"
                   href="#auth-modal">
                    <i class="large material-icons">
                        favorite_border
                    </i>
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
            @if($good->discount_cost)
                <span class="cost-label">
                    <span class="chip small">
                        <s>{{$good->cost}}</s>
                    </span>
                    <span class="chip red white-text large">
                        <u><b>{{$good->discount_cost}}</b></u>
                    </span>
                тг/сутки
                </span>
            @else
                <span class="cost-label">
                    <span class="chip">
                        <b>{{$good->cost}}</b>
                    </span>
                тг/сутки
                </span>
            @endif
        </div>
    </div>
</a>
