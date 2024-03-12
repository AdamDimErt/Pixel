@extends('app')
@section('content')
    <div class="row">
        @if(isset($goodType))
            <h5 class="white-text">{{$goodType->description}}</h5>
        @else
            <h5 class="white-text">Все товары</h5>
        @endif
        @if(count($goods) != 0)
            @foreach($goods as $good)
                <div class="col s12 m6 l3">
                    @include('goodCard', ['good' => $good])
                </div>
            @endforeach
        @else
            <h5>Тут пока ничего нет :(</h5>
        @endif
    </div>
    @push('scripts')
        <script src="{{asset('js/cart.js')}}"></script>
    @endpush
    @include('auth.modal', ['icon' => 'favorite_border', 'title' => 'Необходима аутентификация', 'content' => 'Для добавления товара в "любимые" необходимо аутентифицироваться'])
@endsection
