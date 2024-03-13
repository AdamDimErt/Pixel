<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PixelAlmaty</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{  asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
@include('auth.header')
<div class="container valign-wrapper auth-container">
    <div class="valign-wrapper">
        <div class="main-color center auth-inner">
            <a href="/" class="back-auth-button"><i class="material-icons orange-text text-lighten-3">cancel</i></a>
            <h5 class="white-text">Создайте новый аккаунт</h5>
            <div class="row">
                <form class="col s12" method="POST" action="{{route('register')}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix white-text">account_circle</i>
                            <input name="name" id="name" type="text" placeholder="ФИО" class="white-text">
                        </div>
                        <div class="input-field col s12">
                            <i class="material-icons prefix white-text">phone</i>
                            <input name="phone" id="phone" type="tel" placeholder="Номер телефона" class="white-text">
                        </div>
                        <div class="file-field input-field col s12">
                            <div>
                                <input type="file" name="files[]" multiple="multiple" accept=".jpg,.jpeg,.png">
                            </div>
                            <div class="file-path-wrapper">
                                <i class="material-icons prefix white-text">attach_file</i>
                                <input id="file-path" class="file-path" type="text"
                                       placeholder="Удостоверение личности (с двух сторон)">
                            </div>
                        </div>
                        <div class="input-field col s12">
                            <i class="material-icons prefix white-text">lock</i>
                            <input name="password" type="password" placeholder="Пароль" class="white-text">
                        </div>
                        <div class="input-field col s12">
                            <i class="material-icons prefix white-text">done</i>
                            <input name="password_confirmation" type="password" placeholder="Подтвердите пароль"
                                   class="white-text">
                        </div>
                        <div class="input-field col s12">
                            <button type="submit" class="btn orange darken-4 authorization-link">
                                Зарегистрироваться
                            </button>
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
                    </div>
                    <hr>
                </form>
            </div>
            <span class="white-text">Уже есть аккаунт? <a href="{{route('login')}}" class="orange-text"><u>Войти</u></a></span>
        </div>
    </div>
</div>
</body>
</html>