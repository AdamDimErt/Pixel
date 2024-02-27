<ul id="slide-out" class="sidenav sidenav-fixed">
    <a href="/"><img src="{{asset('img/logo.png')}}"/></a>
    <div class="container">
        <hr>
        @foreach($goodTypes as $goodType)
            <li class="menu-item ">
                <a href="{{route('goodList', $goodType->code, false)}}"
                   class="white-text waves-effect waves-light menu-item-link waves-ripple">
                    <span class="menu-item-content">
                        @if(Request::is('category/' . $goodType->code))
                            <span class="btn-medium btn-floating orange darken-4">
                                <i class="material-icons">{{$goodType->icon}}</i>
                            </span>
                            <span class="orange-text">{{$goodType->name}}</span>
                        @else
                            <span class="btn-medium btn-floating grey darken-4">
                                <i class="material-icons">{{$goodType->icon}}</i>
                            </span>
                            <span class="">{{$goodType->name}}</span>
                        @endif
                    </span>
                </a>
            </li>
        @endforeach
    </div>
</ul>
