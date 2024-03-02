<div class="breadcrumbs-section">
    <div class="col s12">
        <a href="/" class="breadcrumb">
            <span class="breadcrumb-item chip orange darken-4 white-text">
                <b>
                Главная
                </b>
            </span>
        </a>
        @if (Route::is('goodList') && isset($goodType))
            <a href="category/{{$goodType->code}}" class="breadcrumb">
                <span class="breadcrumb-item chip orange darken-4 white-text">
                    <b>
                        {{$goodType->name}}
                    </b>
                </span>
            </a>
        @endif
        @if (Route::is('cart'))
            <a href="/cart" class="breadcrumb">
                <span class="breadcrumb-item chip orange darken-4 white-text">
                <b>
                    Корзина
                </b>
                </span>
            </a>
        @endif
    </div>
</div>
