<section class="clearfix cls-rating-comment">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-md-6 left-rating">
        <div class="well well-sm">
          <div class="row" >
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
                        <span class="sr-only">
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
                    {{ __('Cleanliness') }}
                  </div>
                  <div class="col-xs-8 col-md-9">
                    <div class="progress progress-striped">
                      <div class="progress-bar progress-bar-info" 
                        role="progressbar" aria-valuenow="20"
                        aria-valuemin="0" aria-valuemax="100" 
                        style="width: {{ getProgressPercent($hotel->cleanliness_rating_avg) }}%">
                        <span class="sr-only">
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
                        <span class="sr-only">
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
                        <span class="sr-only">
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
                        <span class="sr-only">
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
        <div class="comment-old">
          <form action="">
            <textarea class="your-comment" placeholder="{{ __('Write your comment.....') }}"></textarea>
            <button class="btn btn-primary" type="submit">{{ __('Submit') }}</button>
          </form>
        </div>
      </div>
      <div class="col-xs-12 col-md-6">
        <div class="cls-contain-comment">
          <h3>{{ __('Comment ( :count_comment )', ['count_comment' => $countComment] ) }}</h3>
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
                {{ $comment->created_at }} </p>
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
