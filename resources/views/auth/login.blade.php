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
            <a href="/" class="back-auth-button"><i class="material-icons orange-text text-lighten-3">cancel</i></a>
            <h5 class="white-text">{{__('translations.Log into your account')}}</h5>
            <div class="row">
                <form class="col s12" method="POST" action="">
                    {{csrf_field()}}
                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix white-text">phone</i>
                            <input name="phone" type="tel" placeholder="{{__('translations.Phone')}}" class="white-text"
                                   id="phone-input" value="+7">
                        </div>
                        <div class="input-field col s12">
                            <i class="material-icons prefix white-text">lock</i>
                            <input name="password" type="password" placeholder="{{__('translations.Password')}}" class="white-text">
                        </div>
                        <div class="input-field col s12">
                            <button type="submit" class="btn orange darken-4 authorization-link">
                                {{__('translations.Log in')}}
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
            <span class="white-text">{{__('translations.Still do not have an account?')}} <a href="{{route('register')}}" class="orange-text"><u>{{__('translations.Register')}}</u></a></span>
            <br>
            <a href="{{route('forgotPassword')}}" class="orange-text" style="margin-right: auto"><u>{{__('translations.Forgot password')}}</u></a>
        </div>
    </div>
</div>
</body>
<script>
    const phoneInput = document.getElementById('phone-input');

    phoneInput.addEventListener('input', function() {
        // Если пользователь попытается удалить +7, оно снова вставится
        if (!this.value.startsWith('+7')) {
            this.value = '+7' + this.value.slice(3);
        }
    });

    phoneInput.addEventListener('keydown', function(event) {
        const cursorPosition = this.selectionStart;

        // Запрещаем удаление +7 с помощью клавиш Backspace и Delete
        if (cursorPosition <= 2 && (event.key === 'Backspace' || event.key === 'Delete')) {
            event.preventDefault();
        }
    });

    phoneInput.addEventListener('click', function() {
        // Перемещаем курсор сразу после +7 при клике в начало инпута
        if (this.selectionStart < 3) {
            this.setSelectionRange(3, 3);
        }
    });

    phoneInput.addEventListener('focus', function() {
        // Перемещаем курсор сразу после +7 при фокусе
        if (this.selectionStart < 3) {
            this.setSelectionRange(3, 3);
        }
    });
</script>
</html>
