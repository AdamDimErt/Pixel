<nav class="navbar-fixed grey darken-3">
    <div class="nav-wrapper">
        <div class="nav-inner-wrapper">
            <div class="brand-logo">
                <div class="search-wrapper valign-wrapper hide-on-med-and-down input-field">
                    <input id="search" type="text" class="validate browser-default text-white center-align autocomplete" placeholder="Поиск">
                    <i class="material-icons">
                        search
                    </i>
                </div>
            </div>
            <ul class="right nav-buttons">
                <li class="nav-element">
                    <a href="/cart" class="nav-link cart-link">
                        <i class="material-icons left navbar-icon">
                            shopping_cart
                        </i>
                        Корзина
                        @if(isset($cartCount) && $cartCount != 0)
                            <span class="badge red white-text">
                                    <span class="in-cart-item-counter">
                                        {{$cartCount}}
                                    </span>
                            </span>
                        @endif
                    </a>
                </li>
                @auth('clients')
                    <li class="nav-element">
                        <a href="#" class="nav-link">
                            <i class="material-icons left navbar-icon">
                                favorite_border
                            </i>
                            Любимое
                        </a>
                    </li>
                    <li class="nav-element">
                        <a href="#" class="nav-link dropdown-trigger" data-target="profile-options">
                            <i class="material-icons left navbar-icon">
                                account_circle
                            </i>
                            Профиль
                        </a>

                        <ul id='profile-options' class='dropdown-content main-color white-text'>
                            <li><a href="#!" class="white-text profile-dropdown-link">Мои заказы</a></li>
                            <li><a href="#!" class="white-text profile-dropdown-link">Просмотреть профиль</a></li>
                            <li class="divider" tabindex="-1"></li>
                            <li><a href="{{route('logout')}}" class="white-text profile-dropdown-link"><i class="material-icons orange-text">cancel</i>Выйти</a></li>
                        </ul>
                    </li>
                @endauth
                @guest('clients')
                    <li class="nav-element">
                        <a href="{{route('login')}}" class="nav-link orange darken-4 auth-link ">
                            Войти
                        </a>
                    </li>
                    <li class="nav-element">
                        <a href="{{route('register')}}" class="nav-link grey darken-4 white-text register-link">
                            Зарегистрироваться
                        </a>
                    </li>
                @endguest
                <li class="hide-on-large-only hide-on-extra-large-only">
                    <a href="#" class="btn-floating btn orange darken-4 white-text">
                        <i class="material-icons">
                            menu
                        </i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var elems = document.querySelectorAll('.autocomplete');
                var data = {
                    @foreach($goodOptions as $goodOption)
                        "{{$goodOption['name']}}": "{{$goodOption['url']}}",
                    @endforeach
                };
                var instances = M.Autocomplete.init(elems, {
                    data: data,
                    limit: 5,
                    onAutocomplete: (item) => {}
                });
            });
        </script>
    @endpush
</nav>
