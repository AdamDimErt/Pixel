<footer class="page-footer grey darken-4 container">
    <div class="row">
        <div class="col l6 s12">
            <h3 class="white-text">Контакты</h3>
            <p class="grey-text text-lighten-4">
                Наше расположение на карте
            </p>
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d2905.9876293833477!2d76.89725877615567!3d43.25168107112397!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zNDPCsDE1JzA2LjEiTiA3NsKwNTMnNTkuNCJF!5e0!3m2!1sen!2skz!4v1709577530294!5m2!1sen!2skz"
                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                class="map-iframe z-depth-4"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div class="col l4 offset-l2 s12 center">
            <h3 class="white-text">Связь с нами:</h3>
            <ul>
                <li>
                    <a class="footer-social valign-wrapper grey-text text-lighten-3" href="https://www.instagram.com/pixel_rental.kz/?hl=en">
                        <img src="{{asset('/img/instagram.svg')}}" height="60px" alt="">
                        <span class="social-media-link">Instagram</span>
                    </a>
                </li>
                <hr>
                <li>
                    <a class="footer-social valign-wrapper grey-text text-lighten-3" href="http://wa.link/pms0of">
                        <img src="{{asset('/img/whatsapp.svg')}}" height="50px" alt="">
                        <span class="social-media-link">Whatsapp</span>
                    </a>
                </li>
                <hr>
                <li>
                    <a class="footer-social valign-wrapper grey-text text-lighten-3" href="https://2gis.kz/almaty/firm/70000001069136996">
                        <img src="{{asset('/img/2gis.svg')}}" height="50px" alt="">
                        <span class="social-media-link">2gis</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            <span class="right">
            {{ now()->year }}<a href="https://msbtrust.kz"><b class="orange-text text-lighten-1"> ©MSB trust</b></a>
            </span>
        </div>
    </div>
</footer>
