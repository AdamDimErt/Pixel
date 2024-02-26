<ul id="slide-out" class="sidenav sidenav-fixed">
    <img src="{{asset('img/logo.png')}}"/>
    <div class="container">
        @foreach($goodTypes as $goodType)
            <li><a href="{{route('goodList', $goodType->code, false)}}" class="white-text">{{$goodType->name}}</a></li>
        @endforeach
    </div>
</ul>
