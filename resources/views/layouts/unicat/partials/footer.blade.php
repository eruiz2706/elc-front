<footer class="footer">
  <div class="footer_background" style="background-image:url({{ URL::asset('rfend/images/footer_background.png') }})"></div>
  <div class="container">
    <div class="row footer_row">
      <div class="col">
        <div class="footer_content">
          <div class="row">

            <div class="col-lg-4 footer_col">

              <!-- Footer About -->
              <div class="footer_section footer_about">
                <div class="footer_logo_container">
                  <a href="#">
                    <div class="footer_logo_text">{{ trans('frontend.elcolp') }}</div>
                  </a>
                </div>
                <div class="footer_about_text">
                  <p>{{ trans('frontend.elcolp_text') }}</p>
                </div>
                <div class="footer_social">
                  <ul>
                    <li><a href="{{url('https://www.facebook.com/elc.quibdo')}}" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                    <li><a href="{{url('https://www.instagram.com/elcquibdo/')}}" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                    <!--<li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>-->
                    <!--<li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>-->
                  </ul>
                </div>
              </div>

            </div>

            <div class="col-lg-4 footer_col">

              <!-- Footer Contact -->
              <div class="footer_section footer_contact">
                <div class="footer_title">{{ trans('frontend.contact') }}</div>
                <div class="footer_contact_info">
                  <ul>
                    <li>{{ trans('frontend.email') }} : {{ trans('frontend.elcolp_email') }} </li>
                    <li>{{ trans('frontend.telephone') }} : {{ trans('frontend.elcolp_phone') }}</li>
                  </ul>
                </div>
              </div>

            </div>

            <div class="col-lg-4 footer_col">

              <!-- Footer links -->
              <div class="footer_section footer_links">
                <div class="footer_title">{{ trans('frontend.navigation') }}</div>
                <div class="footer_links_container">
                  <ul>
                    <li><a href="{{url('/')}}">{{ trans('frontend.nav.home') }}</a></li>
                    <li><a href="{{url('/acercade')}}">{{ trans('frontend.nav.about') }}</a></li>
                    <li><a href="{{url('/cursosd')}}">{{ trans('frontend.nav.courses') }}</a></li>
                    <li><a href="{{url('/contacto')}}">{{ trans('frontend.nav.contact') }}</a></li>
                  </ul>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row copyright_row">
      <div class="col">
        <div class="copyright d-flex flex-lg-row flex-column align-items-center justify-content-start">
          <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
          <!--<div class="cr_text">
            Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
          </div>-->
          <div class="ml-lg-auto cr_links">
            <ul class="cr_list">
              <li><a href="#">{{ trans('frontend.terms_use') }}</a></li>
              <li><a href="#">{{ trans('frontend.policies') }}</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>
