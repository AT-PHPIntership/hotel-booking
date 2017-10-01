<!-- Footer -->
<footer>
  <div class="container">
    <div class="row">
      <div class="col-md-4 col-sm-4">
        <h4>{{ __('About us')}}</h4>
        <p><a href="">{{ __('Home') }}</a><br></p>
        @foreach ($staticPages as $page)
          <p>
            <a href="{{ route('staticPage', ['page' => $page->slug]) }}">
              {{ __($page->title) }}
            </a>
          </p>
        @endforeach    
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
          <p><strong>{{ __('TYND Group Co., Ltd.') }} </strong></p>
          <p>{{ __('567 Ton Duc Thang St, Da Nang') }}</p>
          <p>{{ __('P: 0123 456 999') }}</p>
          <p>{{ __('E: support@tyndgroup.vn')}}</p> 
          <a href="http://tyndgroup.vn">{{ __('W: www.tyndgroup.vn') }}</a>
        </address>
      </div>
    </div>
  </div>
  <div class="footer-bottom">
    <div class="container">
      <div class="row">
        <div class="col-xs-6">
          &copy; {{ __('Copyright Star Hotel Co., Ltd. 2017') }}
        </div>
        <div class="col-xs-6 text-right">
          <ul>
            <li>
              <a href="{{ route('sendfeedback.create') }}" class="cls-feedback">
                {{__('Feedback')}}
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</footer>
