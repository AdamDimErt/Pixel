<ul id="slide-out" class="sidenav sidenav-fixed main-color">
    <div class="logo-wrapper center">
        <a href="/"><img src="{{asset('img/logo.jpg')}}" class="logo"/></a>
    </div>
    <div class="container">
        <hr>
        <li class="menu-item">
            <div class="hide-on-med-and-up search-wrapper valign-wrapper hide-on-med-and-up input-field">
                <input id="search" type="text"
                       class="validate browser-default text-white center-align autocomplete"
                       placeholder="Поиск">
                <i class="material-icons white-text">
                    search
                </i>
            </div>
            <hr class="hide-on-med-and-up">
        </li>
        @foreach($goodTypes as $goodType)
            <li class="menu-item">
                <a href="{{route('goodList', $goodType->code, false)}}"
                   class="white-text waves-effect waves-light menu-item-link waves-ripple">
                    <span class="menu-item-content">
                        @if(Request::is('category/' . $goodType->code))
                            <span class="btn-medium btn-floating orange darken-4">
                                <i class="material-icons">{{$goodType->icon}}</i>
                            </span>
                            <span class="orange-text">{{__( 'translations.'. $goodType->code)}}</span>
                        @else
                            <span class="btn-medium btn-floating grey darken-4">
                                <i class="material-icons">{{$goodType->icon}}</i>
                            </span>
                            <span class="">{{__( 'translations.'. $goodType->code)}}</span>
                        @endif
                    </span>
                </a>
            </li>
        @endforeach
    </div>
</ul>
