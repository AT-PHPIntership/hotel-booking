
<!-- Footer -->
<footer>
  <div class="container">
    <div class="row">
      <div class="col-md-4 col-sm-4">
        <h4>{{ __('About us')}}</h4>
        <p><a href="">{{ __('Home') }}</a><br></p>
        <p><a href="">{{ __('Introduce') }}</a><br></p>
        <p><a href="">{{ __('Contacts') }}</a><br></p>
        <p><a href="">{{ __('Provision')}}</a><br></p>
       
      </div>
     <div class="col-md-4 col-sm-4">
        <h4>{{ __('Connect') }}</h4>
        <p><a href="">Facebook</a><br></p>
        <p><a href="">Google plus</a><br></p>
        <p><a href="">Instagram</a><br></p>
        <p><a href="">Twitter</a><br></p>
       
      </div>
      <div class="col-md-4 col-sm-4">
        <h4>{{ __('Address') }}</h4>
        <address>
        <strong>{{ __('Star Hotel Co., Ltd.') }} </strong><br>
        {{ __('06 Block 03 St, Da Nang') }}<br>
        <a href="#">P: (123) 456-7890</a><br>
        <a href="#">E: hotelteam@starhotel.vn</a><br>
        <a href="#">W: www.starhotel.vn </a><br>
        </address>
      </div>
    </div>
  </div>
  <div class="footer-bottom">
    <div class="container">
      <div class="row">
        <div class="col-xs-6"> &copy; {{ __('Copyright Star Hotel Co., Ltd. 2015') }} </div>
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