@extends('app')
@section('content')
    <div class="container">
        <div class="row">
            @foreach($goods as $good)
                <div class="col s12 m6 l6 xl4">
                    <div class="card">
                        <div class="card-image">
                            <img src="{{$good->attachment()?->first()?->url()}}">
                            <span class="card-title">{{$good->name}}</span>
                            <a class="btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons">add_shopping_cart</i></a>
                        </div>
                        <div class="card-content">
                            <p>I am a very simple card. I am good at containing small bits of information. I am convenient because I require little markup to use effectively.</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
