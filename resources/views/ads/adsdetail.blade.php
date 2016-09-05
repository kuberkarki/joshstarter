@extends('layouts/eventday')

{{-- Page title --}}
@section('title')
{{$ad->title}}
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <!--page level css starts-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/blog.css') }}">
    <!--end of page level css-->
@stop


{{-- Page content --}}
@section('content')
    <!-- Container Section Start -->
    <div class="container">
        <h2 class="primary marl12">{{$ad->title}}</h2>
        <div class="row content">
            <!-- Business Deal Section Start -->
            <div class="col-sm-8 col-md-8">
                <div class=" thumbnail featured-post-wide img">
                   @if($ad->photo)
                        <img src="{{ URL::to('/uploads/crudfiles/'.$ad->photo)  }}" class="img-responsive" alt="Image">
                    @endif
                    @if(count($ad->photos()))
                        <div class="row">
                        <ul class="thumbnails">
                          @foreach($ad->photos()->get() as $photo)
                            <li class="img-{{$photo->id}}"> 
                           
    
                            <img src="{{ URL::to('/uploads/crudfiles/'.$photo->photo)  }}" alt="..."
                                                     class="img-responsive" width="100px" />
                            
                           
                            </li>
                          @endforeach
                          </ul>
                          

                        @endif
                        </div>
                    <!-- /.news-detail-image -->
                    <div class="the-box no-border news-detail-content">
                        <p class="additional-post-wrap">
                            <span>
                            <i class="fa fa-level-up" aria-hidden="true"></i> {!! $ads_category[$ad->ads_category_id] !!}
                            </span>
                            <span class="additional-post">
                              <div class="address"><i class="fa fa-map-marker" aria-hidden="true"></i> {!! $ad->location !!}</div>     
                            </span>

                            
                        </p>
                        <p class="text-justify">
                            {!! $ad->description !!}
                        </p>

                       
                    </div>
                     <div class="adsThumnelButton"><a href="#" class="btn btn-primary">Book Now</a></div>
                </div>
                {{-- dd($ad->reviews()->get()) --}}
                
                <!-- /the.box .no-border -->
                <!-- Media left section start -->
                <h3 class="comments">{{count($ad->reviews()->get())}} Reviews</h3><br />
                <ul class="media-list">
                    @foreach($ad->reviews()->get() as $review)
                        <div class="row">
                            <div class="col-md-12">
                            @for($i=1;$i<=5;$i++)
                                @if($review->rating>=$i)
                                    <span class="glyphicon glyphicon-star"></span>
                                @else
                                    <span class="glyphicon glyphicon-star-empty"></span>
                                @endif
                            @endfor

                            {{-- */$user=App\user::find($review->author_id);/* --}}
                                    {{ $user->first_name  ." ".$user->last_name}} 
                                    <span class="pull-right">
                                    {{ $review->updated_at->diffForHumans() }}
                                    </span> 
                    
                        <p>{{ $review->body }}</p>
                      </div>
                </div>
                    
                    @endforeach
                </ul>
                <!-- //Media left section End -->
                <!-- Comment Section Start -->
                @if(!$reviewed)
                <h3>Leave a Review</h3>
                {!! Form::open(array('url' => URL::to('submit-review'), 'method' => 'post', 'class' => 'bf', 'id'=>'frm' ,'files'=> true)) !!}
                @else
                 <h3>Review again</h3>
                  {!! Form::open(array('url' => URL::to('submit-review-again'), 'method' => 'post', 'class' => 'bf', 'id'=>'frm' ,'files'=> true)) !!}
                    <input type="hidden" name="review_id" value="{!! $reviewed->id !!}">
                @endif
                <input type="hidden" name="id" value="{!! $ad->id !!}">

                <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                    {!! Form::text('title', null, array('class' => 'form-control input-lg','required' => 'required', 'placeholder'=>'Title')) !!}
                    <span class="help-block">{{ $errors->first('title', ':message') }}</span>
                </div>
                
                <div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
                    {!! Form::textarea('body', null, array('class' => 'form-control input-lg no-resize','required' => 'required', 'style'=>'height: 200px', 'placeholder'=>'Your review')) !!}
                    <span class="help-block">{{ $errors->first('body', ':message') }}</span>
                </div>
                <div class="form-group ratingAds">
                    <div data="{!! $ad->id !!}" id="stars" class="stars starrr rating" data-logged="{{Sentinel::check()?true:false}}"></div>
                    <input type="hidden" name="rate" id="rate" />
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-md"><i class="fa fa-comment"></i>
                        Submit
                    </button>
                </div>
                {!! Form::close() !!}
                <!-- //Comment Section End -->
            </div>
            <!-- //Business Deal Section End -->
            <!-- /.col-sm-9 -->
            <!-- Recent Posts Section Start -->
            <div class="col-sm-4 col-md-4 col-full-width-left">
                <div class="the-box">
                        <h3 class="small-heading text-center">RECENT POSTS</h3>
                        <ul class="media-list media-xs media-dotted">
                            <li class="media">
                                <a class="pull-left" href="#">
                                    <img src="{{ asset('assets/images/authors/avatar1.jpg') }}" class="img-circle img-responsive pull-left" alt="riot">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading primary">
                                                        <a href="#">Elizabeth Owens at Duis autem vel eum iriure dolor in hendrerit in</a>
                                                    </h4>
                                    <p class="date">
                                        <small class="text-danger">2hours ago</small>
                                    </p>
                                    <p class="small">
                                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo
                                    </p>
                                </div>
                            </li>
                            <hr>
                            <li class="media">
                                <a class="pull-left" href="#">
                                    <img src="{{ asset('assets/images/authors/avatar4.jpg') }}" class="img-circle img-responsive pull-left" alt="riot">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading primary">
                                                        <a href="#">Harold Chavez at Duis autem vel eum iriure dolor in hendrerit in</a>
                                                    </h4>
                                    <p class="date">
                                        <small class="text-danger">5hours ago</small>
                                    </p>
                                    <p class="small">
                                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo
                                    </p>
                                </div>
                            </li>
                            <hr>
                            <li class="media">
                                <a class="pull-left" href="#">
                                    <img src="{{ asset('assets/images/authors/avatar5.jpg') }}" class="img-circle img-responsive pull-left" alt="riot">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading primary">
                                                        <a href="#">Mihaela Cihac at Duis autem vel eum iriure dolor in hendrerit in</a>
                                                    </h4>
                                    <p class="date">
                                        <small class="text-danger">10hours ago</small>
                                    </p>
                                    <p class="small">
                                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo
                                    </p>
                                </div>
                            </li>
                        </ul>
                </div>
                <!-- /.the-box .bg-primary .no-border .text-center .no-margin -->
            </div>
            <!-- //Recent Posts Section End -->
            <!-- /.col-sm-3 -->
        </div>
    </div>
    <!-- //Conatainer Section End -->
@stop
{{-- page level scripts --}}
@section('footer_scripts')
<script>
  var __slice = [].slice;

(function($, window) {
  var Starrr;

  Starrr = (function() {
    Starrr.prototype.defaults = {
      rating: void 0,
      numStars: 5,
      change: function(e, value) {}
    };

    function Starrr($el, options) {
      var i, _, _ref,
        _this = this;

      this.options = $.extend({}, this.defaults, options);
      this.$el = $el;
      _ref = this.defaults;
      for (i in _ref) {
        _ = _ref[i];
        if (this.$el.data(i) != null) {
          this.options[i] = this.$el.data(i);
        }
      }
      this.createStars();
      this.syncRating();
      this.$el.on('mouseover.starrr', 'span', function(e) {
        return _this.syncRating(_this.$el.find('span').index(e.currentTarget) + 1);
      });
      this.$el.on('mouseout.starrr', function() {
        return _this.syncRating();
      });
      this.$el.on('click.starrr', 'span', function(e) {
        return _this.setRating(_this.$el.find('span').index(e.currentTarget) + 1);
      });
      this.$el.on('starrr:change', this.options.change);
    }

    Starrr.prototype.createStars = function() {
      var _i, _ref, _results;

      _results = [];
      for (_i = 1, _ref = this.options.numStars; 1 <= _ref ? _i <= _ref : _i >= _ref; 1 <= _ref ? _i++ : _i--) {
        _results.push(this.$el.append("<span class='glyphicon .glyphicon-star-empty'></span>"));
      }
      return _results;
    };

    Starrr.prototype.setRating = function(rating) {
      if (this.options.rating === rating) {
        rating = void 0;
      }
      this.options.rating = rating;
      this.syncRating();
      return this.$el.trigger('starrr:change', rating);
    };

    Starrr.prototype.syncRating = function(rating) {
      var i, _i, _j, _ref;

      rating || (rating = this.options.rating);
      if (rating) {
        for (i = _i = 0, _ref = rating - 1; 0 <= _ref ? _i <= _ref : _i >= _ref; i = 0 <= _ref ? ++_i : --_i) {
          this.$el.find('span').eq(i).removeClass('glyphicon-star-empty').addClass('glyphicon-star');
        }
      }
      if (rating && rating < 5) {
        for (i = _j = rating; rating <= 4 ? _j <= 4 : _j >= 4; i = rating <= 4 ? ++_j : --_j) {
          this.$el.find('span').eq(i).removeClass('glyphicon-star').addClass('glyphicon-star-empty');
        }
      }
      if (!rating) {
        return this.$el.find('span').removeClass('glyphicon-star').addClass('glyphicon-star-empty');
      }
    };

    return Starrr;

  })();
  return $.fn.extend({
    starrr: function() {
      var args, option;

      option = arguments[0], args = 2 <= arguments.length ? __slice.call(arguments, 1) : [];
      return this.each(function() {
        var data;

        data = $(this).data('star-rating');
        if (!data) {
          $(this).data('star-rating', (data = new Starrr($(this), option)));
        }
        if (typeof option === 'string') {
          return data[option].apply(data, args);
        }
      });
    }
  });
})(window.jQuery, window);

$(function() {
  return $(".starrr").starrr();
});

$( document ).ready(function() {
      
  $('.stars').on('starrr:change', function(e, value){
    //$('#count').html(value);
    var adid = $(this).attr("data");
    var logged = $(this).data("logged");
    if(!logged){
      alert('Your rating is noy updated. Please Login First !!');
      return false;
    }

    $('#rate').val(value)
    //alert(adid)
    /*$.ajax({
              type: "POST",
              dataType: "json",
              url: "{{ URL::route('rate-ads') }}",
              data: { id: adid,rating: value, "_token": "{{ csrf_token() }}" },
              success:function(result){
                //alert('.img-'+photoid);
                console.log(result);
                $('#total-'+adid).html(result.total);
                //$('.img-'+photoid).hide();
                //alert(result.response)
             // $("#sharelink").html(result);
             //alert(result);
            },
            error:function(result){
              alert('Please Login to rate');
            }
          });*/
  });
  
  $('#stars-existing').on('starrr:change', function(e, value){
    //$('#count-existing').html(value);
  });

  $( "#frm" ).submit(function( event ) {
      
      if($('#rate').val()==''){
        alert('Please Rate');
        return false;
      }

    });
});
</script>

@stop
