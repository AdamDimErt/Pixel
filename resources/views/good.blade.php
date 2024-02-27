@extends('app')
@section('content')
    <div class="container">
        <div class="row">
            <h4 class="white-text">{{$goodTypeDesc}}</h4>
            @foreach($goods as $good)
                <div class="col s12 m6 l6 xl3">
                    <div class="card z-depth-3">
                        <div class="card-image">
                            <img src="{{$good->attachment()?->first()?->url()}}">
                            <a class="btn-floating halfway-fab waves-effect waves-light orange darken-4"><i
                                    class="large material-icons">add_shopping_cart</i></a>

                            {{--                            <div class="chip darken-4 orange white-text">--}}
                            {{--                                <b>{{$good->goodType->name}}</b>--}}
                            {{--                            </div>--}}
                        </div>
                        <div class="card-content">
                            <span class="card-title">{{$good->name}}</span>
                            <span class="card-subtitle right">
                                <span class="chip">
                                    {{$good->cost}}
                                </span>
                                тг/сутки</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
