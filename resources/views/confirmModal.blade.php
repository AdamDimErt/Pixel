<div id="{{$modalClass}}" class="modal bottom-sheet">
    <div class="modal-content container center">
        <h4>{{$title}}</h4>
        <p>{{$subTitle}}</p>
        <p><a href="{{$link}}">{{$linkCaption}}</a></p>
        <p>{{$downTitle}}</p>
        <input type="hidden" name="{{$fieldName}}" value="{{$fieldValue}}">
{{--        <p>После подтверждения оформления заказа ваш заказ будет передан менеджеру и вы сможете получить свой товар в пункте выдачи по адресу:</p>--}}
{{--        <a href="https://2gis.kz/almaty/firm/70000001069136996">Улица Толе БИ, 176.</a>--}}
{{--        <p>Менеджер ещё раз перепроверит ваши контактные данные и фотографии удостоверения, после чего будет подписан договор об аренде оборудования.</p>--}}
    </div>
    <div class="divider"></div>
    <div class="modal-footer">
        <div class="row center">
            <button class="btn-large nav-link orange darken-4 auth-link confirm-order-btn" onclick="{{$btnAction}}">
                {{$btnCaption}}
                <i class="material-icons">done</i>
            </button>
        </div>
    </div>
</div>
