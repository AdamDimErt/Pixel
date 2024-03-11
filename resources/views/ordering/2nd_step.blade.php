@extends('app')
@section('content')
    @auth('clients')
        <h4 class="white-text">Оформление заказа</h4>
        <p class="grey-text">Дата и время аренды:</p>
        <input type="hidden" value="{{$totalCount}}" id="total_count">
        <input type="hidden" value="{{$totalPrice}}" id="total_price">
        <div class="row">
            <div class="col s12 m3 additional-info white-text hide-on-med-and-up">
                <span class="grey-text">Шаг 2 из 3</span>
                <p>Укажите дату и время начала аренды, и окончания аренды оборудования</p>
                <hr>
                <p><b>ВАЖНО!</b></p>
                <p>Примите к сведению: За просрочку выплаты платежей, указанных в договоре, Арендодатель в праве
                    требовать от Арендатора выплатить пеню в размере 5 % от не выплаченного платежа за каждый день
                    просрочки</p>
            </div>
            <form action="{{route('settleOrder')}}" method="POST">
                {{csrf_field()}}
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
                        <div class="col s12">
                            <h5 id="final-item-counter" class="white-text"></h5>
                            <h5 id="final-date-counter" class="white-text"></h5>
                            <h4 id="final-price-counter" class="white-text"></h4>
                        </div>
                        <div id="confirm-holder" class="col s12">
                        </div>
                    </div>
                </div>
                <div class="col s12 m3 pull-s2 additional-info white-text hide-on-med-and-down">
                    <span class="grey-text">Шаг 2 из 3</span>
                    <p>Укажите дату и время начала аренды, и окончания аренды оборудования</p>
                    <hr>
                    <p><b>ВАЖНО!</b></p>
                    <p>Примите к сведению: За просрочку выплаты платежей, указанных в договоре, Арендодатель в праве
                        требовать от Арендатора выплатить пеню в размере 5 % от не выплаченного платежа за каждый день
                        просрочки</p>
                </div>
                @include('confirmModal')
            </form>
        </div>
    @endauth
    @push('scripts')
        <script src="{{asset('js/finalDate.js')}}"></script>
    @endpush
@endsection
