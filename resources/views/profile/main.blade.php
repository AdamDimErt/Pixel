@extends('app')
@section('content')
    <h5 class="white-text">Ваш профиль:</h5>
    <a href="{{route('editProfile')}}" class="btn orange darken-4 white-text">Редактировать <i class="material-icons">create</i></a>
    <ul class="collection basic-info grey z-depth-5">
        <li class="collection-item grey darken-3 white-text">ФИО: <span class="orange-text">{{$client->name}}</span>
        </li>
        <li class="collection-item grey darken-3 white-text">Контактный номер телефона: <span
                class="orange-text">{{$client->phone}}</span></li>
        <li class="collection-item grey darken-3 white-text">Дата регистрации: <span
                class="orange-text">{{$client->created_at}}</span></li>
        <li class="collection-item grey darken-3 white-text">Последнее изменение профиля: <span
                class="orange-text">{{$client->updated_at}}</span></li>
        <li class="collection-item grey darken-3 white-text"><p>Общее количество заказов: <span
                    class="orange-text"><b>{{$client->order_amount}}</b></span></p></li>
        <li class="collection-item grey darken-3 white-text"><p>Всего было арендовано товаров: <span
                    class="orange-text"><b>{{$client->order_item_amount}}</b></span></p></li>
    </ul>
    <h5 class="white-text">Фотографии удостоверения личности: </h5>
    <div class="id-image-wrapper row">
        @foreach($client->attachment()->get() as $idPicture)
            <img class="materialboxed id-image z-depth-5" src="{{$idPicture->url}}">
        @endforeach
    </div>
@endsection
