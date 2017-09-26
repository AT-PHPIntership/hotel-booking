<section class="clearfix cls-rating-comment" id="section-rating-comment">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-md-6 left-rating">
        <div class="well well-sm">
          <div class="row" >
            @php($user = \Auth::user())
            @if($countComment != 0)
              <div class="col-xs-12 col-md-6 text-center rating-box">
                <h1 class="rating-num">{{ $hotel->round_avg_rating }}</h1>
                <div class="count-rating-guest">
                  <span>{{ __('According to ') }}<strong>{{ $countComment }}</strong> {{ __(' guests') }}</span>
                </div>
              </div>
              <div class="col-xs-12 col-md-6">
                <div class="row rating-desc">
                  <div class="col-xs-3 col-md-3 text-right">
                    {{ __('Food') }}
                  </div>
                  <div class="col-xs-8 col-md-9">
                    <div class="progress progress-striped">
                      <div class="progress-bar progress-bar-info" 
                        role="progressbar" 
                        aria-valuemin="0" aria-valuemax="100" 
                        style="width: {{ getProgressPercent($hotel->food_rating_avg) }}%">
                        <span class="sr-only cls-rating-view">
                          {{ $hotel->food_rating_avg }}
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xs-12 col-md-6">
                <div class="row rating-desc">
                  <div class="col-xs-3 col-md-3 text-right">
                    {{ __('Clean') }}
                  </div>
                  <div class="col-xs-8 col-md-9">
                    <div class="progress progress-striped">
                      <div class="progress-bar progress-bar-info" 
                        role="progressbar" aria-valuenow="20"
                        aria-valuemin="0" aria-valuemax="100" 
                        style="width: {{ getProgressPercent($hotel->cleanliness_rating_avg) }}%">
                        <span class="sr-only cls-rating-view">
                          {{ $hotel->cleanliness_rating_avg }}
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xs-12 col-md-6">
                <div class="row rating-desc">
                  <div class="col-xs-3 col-md-3 text-right">
                    {{ __('Location') }}
                  </div>
                  <div class="col-xs-8 col-md-9">
                    <div class="progress progress-striped">
                      <div class="progress-bar progress-bar-info" 
                        role="progressbar" aria-valuenow="20"
                        aria-valuemin="0" aria-valuemax="100" 
                        style="width: {{ getProgressPercent($hotel->location_rating_avg) }}%">
                        <span class="sr-only cls-rating-view">
                          {{ $hotel->location_rating_avg }}
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xs-12 col-md-6">
                <div class="row rating-desc">
                  <div class="col-xs-3 col-md-3 text-right">
                    {{ __('Service') }}
                  </div>
                  <div class="col-xs-8 col-md-9">
                    <div class="progress progress-striped">
                      <div class="progress-bar progress-bar-info" 
                        role="progressbar" aria-valuenow="20"
                        aria-valuemin="0" aria-valuemax="100" 
                        style="width: {{ getProgressPercent($hotel->service_rating_avg) }}%">
                        <span class="sr-only cls-rating-view">
                          {{ $hotel->service_rating_avg }}
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xs-12 col-md-6">
                <div class="row rating-desc">
                  <div class="col-xs-3 col-md-3 text-right">
                    {{ __('Comfort') }}
                  </div>
                  <div class="col-xs-8 col-md-9">
                    <div class="progress progress-striped">
                      <div class="progress-bar progress-bar-info" 
                        role="progressbar" aria-valuenow="20"
                        aria-valuemin="0" aria-valuemax="100" 
                        style="width: {{ getProgressPercent($hotel->comfort_rating_avg) }}%">
                        <span class="sr-only cls-rating-view">
                          {{ $hotel->comfort_rating_avg }}
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @else 
              <div class="col-xs-12 text-center rating-box">
                <h4 class="text-left">
                  <i class="no-rating">{{ __('There are no reviews yet. Do you want to be the first to comment?')}}
                  </i>
                </h4>  
              </div>    
            @endif 
          </div> 
        </div>
         
        <div class="cls-user-comment-rating" id="content-comment-rating">
          @if(Auth::check())
            <form action="{{ route('comments.store') }}" method="POST" id="comment-rating">
              {!! csrf_field() !!}
              <div class="cls-contain-rating-input">
                <div class="clearfix " >
                  <label class="cls-label-rating pull-left mr-10">{{ __('Food') }}</label><input type="range" min="1" max="10" name="food" class="slider-rating cls-slider-rating" id="food-input" value="5">
                   <i id="food-value" class="ml-5 cls-rating-point"></i> 
                </div>
                
                <div class="clearfix">
                  <label class="cls-label-rating pull-left mr-10">{{ __('Clean') }}</label>
                  <input type="range" min="1" max="10"  name="cleanliness" class="slider-rating cls-slider-rating" id="cleanliness-input" value="5">
                   <i id="cleanliness-value" class="ml-5 cls-rating-point"></i> 
                </div>
                <div class="clearfix">
                  <label class="cls-label-rating pull-left mr-10">{{ __('Location') }}</label> 
                  <input type="range" min="1" max="10"  name="location" class="slider-rating cls-slider-rating" id="location-input" value="5">
                   <i id="location-value" class="ml-5 cls-rating-point"></i> 
                </div>
                <div class="clearfix">
                  <label class="cls-label-rating pull-left mr-10 ">{{ __('Service') }}</label> 
                  <input type="range" min="1" max="10"  name="service" class="slider-rating cls-slider-rating" id="service-input" value="5">
                   <i id="service-value" class="ml-5 cls-rating-point"></i> 
                </div>
                <div class="clearfix">
                  <label class="cls-label-rating pull-left mr-10">{{ __('Comfort') }}</label> 
                  <input type="range" min="1" max="10"  name="comfort" class="slider-rating cls-slider-rating" id="comfort-input" value="5">
                   <i id="comfort-value" class="ml-5 cls-rating-point"></i> 
                </div>
                <div class="cls-contain-total-rating"> {{ __('Total rating you choosed:') }} 
                  <input id="avg-rating" name="total_rating" class="text-danger total-rating" readonly = "readonly" >
                </div>
                <div class="alert alert-warning" id="message-update-comment" hidden="false">
                  <p>{{ __('Do you want to update comment?') }}</p>
                </div>
              </div>
             
              <input type="hidden" name="hotel_id" 
                value="{{ Request::has('hotel_id') ? Request::all()['hotel_id'] : $hotel->id }}">
              <input type="hidden" name="user_id" value=" {{ \Auth::user()->id }}">
              <textarea id='comment-content' class="hotel-user-comment" 
                placeholder="{{ old('comment') ? '' : __('Write your comment.....') }}" name="comment">{{ old('comment') }}</textarea>
              <button class="btn btn-primary pull-right" type="submit">{{ __('Submit') }}</button>
              <a id="cancel-btn" class="btn btn-default pull-right  mr-10" >{{ __('Cancel') }}</a>
              <div class="error-message">
                @if ($errors->has('comment'))
                  <div class="help-block">
                    <strong class="text-danger">{{ $errors->first('comment') }}</strong>
                  </div>
                @endif
              </div>
            </form>
          @else 
            <div class="cls-login-now">
              {{ __('Please') }} <a href="{{ route('login') }}">{{(' login')}}</a> {{ __('to post comment') }} !
            </div>
          @endif
        </div>
      </div>
      <div class="col-xs-12 col-md-6">
        <div class="cls-contain-comment">
          <h3>{{ __('Comment ( :count_comment )', ['count_comment' => $countComment] ) }}</h3>
          <div class="text-center">
            @include('flash::message')
            @include('backend.layouts.partials.modal')
          </div>
          @if($countComment != 0)

            @foreach ($ratingComments as $comment) 
              <div class="col-md-12 comment-old">
                <div class="total-rating-circle">
                  <span class="cls-value-rating">{{ $comment->round_total_rating }}</span>
                </div>
                <h4 class="cls-username-comment">{{ $comment->user->username }}</h4>
                <p class="cls-comment-content">{{ $comment->comment }}
                </p>
                <p class="cls-comment-at">
                {{ $comment->created_at }}
                @if(Auth::check())
                  @if($user->id == $comment->user->id)
                     
                    <div class="cls-update-delete-rating clearfix pull-right">
                      <span class="update-rating">
                        
                        <a href="#" class="cls-link-update-rating" data-hotel-id='{{ $hotel->id }}' data-comment-id= {{ $comment->id }}
                          data-comment='{{ $comment->comment }}' title="{{ _('Update comment ') }}">
                        <i class="fa fa-pencil-square fz-20" aria-hidden="true"></i>
                      </a>
                      </span>
                      <form method="POST" action="{{ route('comments.destroy', $comment->id) }}" class="cls-form-delete-rating inline">
                        {!! csrf_field() !!}
                        {{ method_field('DELETE') }}
                        <button class="btn btn-confirm"
                          data-title="{{ __('Confirm deletion!') }}"
                          data-confirm="{{ __('Are you sure you want to delete?') }}" 
                          type="submit" title="Delete comment" >
                          <i class="fa fa-times fz-20" aria-hidden="true"></i>
                        </button>
                      </form> 
                    </div>
                  @endif 
                @endif 
                </p>
              </div>
            @endforeach  
            {{ $ratingComments->render() }}
          @else 
            <div class="col-md-6">
              {{ __('No comments for this hotel.') }}
            </div>   
          @endif    
        </div>
      </div>
    </div>
    {{-- end row --}}
  </div>
</section>
