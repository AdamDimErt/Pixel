@extends('app')
@section('content')
    <h5 class="white-text page-presenter-header">Редактирование профиля:</h5>
    <form method="POST" action="{{route('updateProfile')}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="container profile-form-wrapper z-depth-5">
            <div class="input-field">
                <i class="material-icons prefix white-text">account_circle</i>
                <input name="name" id="name" value={{$client->name}} type="text" placeholder="ФИО" class="white-text" required>
            </div>
            <div class="input-field">
                <i class="material-icons prefix white-text">phone</i>
                <input name="phone" id="phone" value={{$client->phone}} type="tel" placeholder="Номер телефона" class="white-text" required>
            </div>
            <div class="input-field">
                <i class="material-icons prefix white-text">email</i>
                <input name="email" id="email" value={{$client->email}} type="tel" placeholder="Почтовый адрес" class="white-text" required>
            </div>
            <div class="file-field input-field">
                <div>
                    <input type="file" name="files[]" multiple="multiple" accept=".jpg,.jpeg,.png">
                </div>
                <div class="file-path-wrapper">
                    <i class="material-icons prefix white-text">attach_file</i>
                    <input id="file-path" class="file-path" type="text"
                           placeholder="Удостоверение личности (с двух сторон)">
                </div>
            </div>
            <hr>
            <button type="submit" class="btn btn-medium save-profile-btn orange darken-4 white-text">Сохранить <i class="material-icons">save</i></button>
        </div>
        @if ($errors->any())
            <div class="col s12">
                <ul class="red-text">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </form>
@endsection