@extends('app')
@section('content')
    @auth('clients')
        <h4 class="white-text">Оформление заказа</h4>
        <p class="grey-text">Дата и время аренды:</p>
        <div class="row">
            <div class="col s12 m9">
                <div class="row">
                    <div class="col s12 input-field">
                        <input name="start_date" id="start_date" type="text" class="datepicker white-text">
                        <label for="rent_start_date">Дата начала аренды: </label>
                    </div>
                    <div class="col s12 input-field">
                        <input name="end_date" id="end_date" type="text" class="datepicker white-text">
                        <label for="rent_end_date">Дата конца аренды:</label>
                    </div>
                </div>
            </div>
            <hr>
            <div class="col s12 m3 additional-info white-text">
                <span class="grey-text">Шаг 2 из 3</span>
                <p>Укажите дату и время начала аренды, и окончания аренды оборудования</p>
                <hr>
                <p><b>ВАЖНО!</b></p>
                <p>Примите к сведению: За просрочку выплаты платежей, указанных в договоре, Арендодатель в праве
                    требовать от Арендатора выплатить пеню в размере 5 % от не выплаченного платежа за каждый день
                    просрочки</p>
            </div>
        </div>
        <h1 id="final-date-counter" class="white-text"></h1>
    @endauth
    @push('scripts')
        <script src="{{asset('js/finalDate.js')}}"></script>
    @endpush
@endsection
