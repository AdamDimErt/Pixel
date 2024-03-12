<a href="/{{$good->id}}">
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
</a>
