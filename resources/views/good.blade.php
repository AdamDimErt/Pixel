@extends('app')
@section('content')
    <div class="row">
        @if(isset($goodType))
            <h5 class="white-text page-presenter-header">{{$goodType->description}}</h5>
        @else
            <h5 class="white-text page-presenter-header">{{__('translations.All goods')}}</h5>
        @endif
        @if(count($goods) != 0)
            @foreach($goods as $good)
                <div class="col s6 m4 l3">
                    @include('goodCard', ['good' => $good])
                </div>
            @endforeach
        @else
            <h5 class="white-text center">{{__('translations.There is nothing here yet')}} :(</h5>
        @endif
    </div>
    @push('scripts')
        <script src="{{asset('js/favoriteActions.js')}}"></script>
        <script src="{{asset('js/cart.js')}}"></script>
    @endpush
    @include('auth.modal', ['icon' => 'favorite_border', 'title' => __('translations.Authorization required'), 'content' => __('translations.To add a product to your favorites, you must be authenticated')])
@endsection
