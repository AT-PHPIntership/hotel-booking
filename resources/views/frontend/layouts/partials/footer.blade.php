
<!-- Footer -->
<footer>
  <div class="container">
    <div class="row">
      <div class="col-md-4 col-sm-4">
        <h4>{{ __('About Us') }}</h4>
        <p><a href="">{{ __('Home') }}</a><br></p>
        <p><a href="">{{ __('Introduce') }}</a><br></p>
        <p><a href="">{{ __('Contacts')}}</a><br></p>
        <p><a href="">{{ __('Provision') }}</a><br></p>
       
      </div>
     <div class="col-md-4 col-sm-4">
        <h4>{{ __('Connect') }}</h4>
        <p><a href="">{{ __('Facebook') }}</a><br></p>
        <p><a href="">{{ __('Google plus') }}</a><br></p>
        <p><a href="">{{ __('Instagram') }}</a><br></p>
        <p><a href="">{{ __('Twitter') }}</a><br></p>
       
      </div>
      <div class="col-md-4 col-sm-4">
        <h4>{{ __('Address') }}</h4>
        <address>
        <strong>{{ __('Asian Tech Commpany') }}</strong><br>
         {{ __('Lô 6, Đường Số 3,, An Hải Bắc, Sơn Trà, Đà Nẵng') }}<br>
        <a href="#">{{ __('Phone') }}: {{ __('(123) 456-7890') }}</a><br>
        <a href="#">{{ __('Email') }}: {{ __('asiantech@asiantech.vn') }}</a><br>
        <a href="#">{{ __('Website') }}: {{ __('www.asiantech.vn') }}</a><br>
        </address>
      </div>
    </div>
  </div>
  <div class="footer-bottom">
    <div class="container">
      <div class="row">
        <div class="col-xs-6"> &copy; {{__('Coppy right Belong to Asian Tech Company')}} </div>
        <div class="col-xs-6 text-right">
          <ul>
            <li><a href="{{ route('sendfeedback.create') }}" class="cls-feedback">{{__('Feedback')}}</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</footer>