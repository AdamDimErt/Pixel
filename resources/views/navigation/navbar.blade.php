<nav class="navbar-fixed grey darken-3">
    <div class="nav-wrapper">
        <div class="nav-inner-wrapper">
            <div class="brand-logo">
                <div class="search-wrapper valign-wrapper hide-on-med-and-down">
                    <input id="search" type="text" class="validate browser-default text-white center-align autocomplete" placeholder="Поиск">
                    <i class="material-icons">
                        search
                    </i>
                </div>
            </div>
            <ul class="right nav-buttons">
                <li class="nav-element"><a href="#"><i class="material-icons">shopping_cart</i>Корзина</a></li>
                @auth
                    <li class="nav-element"><a href="#">Любимое</a></li>
                    <li class="nav-element"><a href="#">Профиль</a></li>
                @endauth
                @guest
                    <li class="nav-element"><a href="#">Войти</a></li>
                    <li class="nav-element"><a href="#">Зарегистрироваться</a></li>
                @endguest
                <li class="hide-on-large-only hide-on-extra-large-only"><a href="#" class="btn-floating btn orange darken-4 white-text"><i class="material-icons">menu</i></a></li>
            </ul>
        </div>
    </div>
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var elems = document.querySelectorAll('.autocomplete');
                var instances = M.Autocomplete.init(elems, {
                    data: {
                        'Apple': null
{{--                        @foreach($goodOptions as $goodOption => $id)--}}
{{--                            "{{$goodOption}}": null,--}}
{{--                        @endforeach--}}
                    },
                });
            });
        </script>
    @endpush
</nav>
