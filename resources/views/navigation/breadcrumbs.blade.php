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
        @if (Route::is('viewProfile'))
            <a href="#" class="breadcrumb">
                <span class="breadcrumb-item chip orange darken-4 white-text">
                    <b>
                        Профиль
                    </b>
                </span>
            </a>
        @endif
        @if (Route::is('editProfile'))
            <a href="{{route('viewProfile')}}" class="breadcrumb">
                <span class="breadcrumb-item chip orange darken-4 white-text">
                    <b>
                        Профиль
                    </b>
                </span>
            </a>
            <a href="#" class="breadcrumb">
                <span class="breadcrumb-item chip orange darken-4 white-text">
                    <b>
                        Редактирование
                    </b>
                </span>
            </a>
        @endif
        @if (Route::is('viewGood') && isset($good))
            <a href="category/{{$good->goodType->code}}" class="breadcrumb">
                <span class="breadcrumb-item chip orange darken-4 white-text">
                    <b>
                        {{$good->goodType->name}}
                    </b>
                </span>
            </a>
            <a href="{{route('viewGood', $good)}}" class="breadcrumb">
                <span class="breadcrumb-item chip orange darken-4 white-text">
                    <b>
                        {{$good->name}}
                    </b>
                </span>
            </a>
        @endif
        @if (Route::is('getFavorites'))
            <a href="{{route('getFavorites')}}" class="breadcrumb">
                <span class="breadcrumb-item chip orange darken-4 white-text">
                    <b>
                        Любимое
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
