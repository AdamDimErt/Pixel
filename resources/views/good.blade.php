@extends('app')
@section('content')
    <div class="container">
        <div class="row">
            @foreach($goods as $good)
                <div class="col s12 m6 l6 xl4">
                    <div class="card z-depth-3">
                        <div class="card-image">
                            <img src="{{$good->attachment()?->first()?->url()}}">
                            <a class="btn-floating halfway-fab waves-effect waves-light red"><i class="large material-icons">add_shopping_cart</i></a>

{{--                            <div class="chip darken-4 orange white-text">--}}
{{--                                <b>{{$good->goodType->name}}</b>--}}
{{--                            </div>--}}
                        </div>
                        <div class="card-content">
                            <span class="card-title">{{$good->name}}</span>
                            <span class="card-subtitle right">{{$good->cost}} тг/сутки</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
