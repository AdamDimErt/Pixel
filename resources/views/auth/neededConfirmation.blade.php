<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>pixelrental</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{  asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
@include('auth.header')
<div class="container valign-wrapper auth-container">
    <div class="valign-wrapper">
        <div class="main-color center auth-inner">
            <h5 class="white-text">Профиль успешно создан!</h5>
            <p class="white-text">Проверьте свой почтовый ящик для подтверждения электронного адреса</p>
            <hr>
            <a href="{{route('login')}}" class="btn btn-large orange darken-4 white-text confirmation-btn z-depth-5">Войти</a>
        </div>
    </div>
</div>
</body>
</html>