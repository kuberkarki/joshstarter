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
<section class="mainContainer">
<div class="contantWrapper innercontantWrapper customerEvent">
  <div class="container globalWrap">
    <div class="row">
      <div class="col-sm-9">
      <h2>{{$ad->title}} 
      <span><i class="fa fa-map-marker" aria-hidden="true"></i> {!! $ad->location !!}</span></h2>
      Category: <a href="{{ url('list-ads/'.$ad->slug)}}"> {!! $ads_category[$ad->ads_category_id] !!}</a>

      </div>
      <div class="col-sm-3">
        <div class="buyButton pullright"><a type="button" class="btn btn-secondary searchBtn">Book Now</a></div>
                                    <button  class="btn btn-primary" data-toggle="modal" data-target="#myModal">Send Message</button> 

      </div>
    </div>

    <div class="row">
    @include('notifications')
      <div class="col-sm-8">
        <div class="customerEventL">
        <div class="eventImg">
           @if($ad->photo)
              <img src="{{ URL::to('/uploads/crudfiles/'.$ad->photo)  }}" class="img-responsive" alt="Image">
          @endif
        </div>
        <div class="navPhotoVideo">
          <a href="#">Photo</a><a href="#">Video Promo</a>
        </div>
        <p>{!! $ad->description !!}</p>

        <div class="customerGallery" style="display:none">
          <div id="gallery" >
           @if(count($ad->photos()))
           
            @foreach($ad->photos()->get() as $photo)            
            <img alt="Preview Image 1"
               src="{{ URL::to('/uploads/crudfiles/'.$photo->photo)  }}"
               data-image="{{ URL::to('/uploads/crudfiles/'.$photo->photo)  }}"
               data-description="Preview Image 1 Description" />
              @endforeach
            @endif
            
               
          </div>
        </div>

        <div class="socialTicket">
          <div class="row">
            <div class="col-sm-6">
              <div class="customerSocial">
              <a href="#"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
              <a href="#"><i class="fa fa-twitter-square" aria-hidden="true"></i></a>
              <a href="#"><i class="fa fa-pinterest-square" aria-hidden="true"></i></a>
              <a href="#"><i class="fa fa-envelope-square" aria-hidden="true"></i></a>
            </div>
            </div>
            <div class="col-sm-6">
              <div class="favBox pull-right"><a type="button" class="btn btn-secondary"><i class="fa fa-heart-o" aria-hidden="true"></i> (51) Ticket Available</a></div>
            </div>
          </div>
        </div>
        <div class="latestUpdate">
          <div class="headingCustomerPara">Latest Update</div>
          <div class="row updateBG">
          <div class="col-sm-12">
          <div class="headingCustomerPara">Latest Update</div>
            
          <p>
If you are looking for live wedding music at your ceremony, or to find a performer who will amaze the guests at your drinks reception, you are in the right place! Warble Entertainment provides musicians, such as string quartets and harpists who are perfect to create a romantic ambience, and unique and fun wedding entertainment ideas with magicians, caricaturists and more!</p>
          </div>
            <div class="col-sm-6">
              <ul>
                <li><a href="#">News</a></li>
                <li><a href="#">Photo</a></li>
                <li><a href="#">Video</a></li>
              </ul>
            </div>
            <div class="col-sm-6"><span class="publish"><a href="#"> Publish</a></span></div>
          </div>
        </div>


         <div class="reviewSection">
            <div class="headingCustomerPara">Reviews({{count($ad->reviews()->get())}})</div>
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
            </div>
          </div>
      </div>
      <div class="col-sm-4">
        <div class="leftContent">
          <div class="leftList">
            <h3>Business Owner</h3>
            {{$ad->owner()->first()->company_name}}
            <img src="{{asset('assets/images/eventday/organizer1.jpg')}}" class="img-responsive">
            <p>{!! $ad->owner()->first()->bio !!}<br>
            <i class="fa fa-phone" aria-hidden="true"></i> {!! $ad->owner()->first()->office_phone !!}<br>
            <!-- <i class="fa fa-globe" aria-hidden="true"></i> www.event.com<br> -->
            <i class="fa fa-map-marker" aria-hidden="true"></i> {!! $ad->owner()->first()->address !!}<br>
            
            <h3>Rating</h3>
            <ul>
              <li><div class="rating"><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i></div><span class="review">(23)</span></li>
            </ul>
          </div>
        </div>

        <div class="leftContent">
          <div class="leftList">

            <h3>Location</h3>
            <img src="{{asset('assets/images/eventday/maps.jpg')}}" class="img-responsive">
          </div>
        </div>

        <div class="leftContent">
          <div class="leftList">

            <h3>Sponsors</h3>
            <img src="{{asset('assets/images/eventday/sponsor1.jpg')}}" class="img-responsive">
          </div>
        </div>

        <div class="leftContent">
          <div class="leftList otherEvent">
            <h3>Other Events</h3>
            <p><a href="#"><span class="otherEventTitle">Wedding venue NYC(New York, NY)</span>
sed do eiusmod tempor incididunt ut labore et dolore...</a></p>
            <p><a href="#"><span class="otherEventTitle">Wedding venue NYC(New York, NY)</span>
sed do eiusmod tempor incididunt ut labore et dolore...</a></p>
            <p><a href="#"><span class="otherEventTitle">Wedding venue NYC(New York, NY)</span>
sed do eiusmod tempor incididunt ut labore et dolore...</a></p>
            <p><a href="#"><span class="otherEventTitle">Wedding venue NYC(New York, NY)</span>
sed do eiusmod tempor incididunt ut labore et dolore...</a></p>
            <p><a href="#"><span class="otherEventTitle">Wedding venue NYC(New York, NY)</span>
sed do eiusmod tempor incididunt ut labore et dolore...</a></p>
          </div>
        </div>

        <div class="leftContent">
          <div class="leftList">
            <img src="{{asset('assets/images/eventday/customerads1.jpg')}}" class="img-responsive">
          </div>
        </div>
      </div>
      </div>
  </div>
    
</div>
</section>
<section class="contantWrapper testimonial">
  <div class="container">
    <div class="row">
      <div class="col-xs-3"><span class="borderBtm"></span></div>
      <div class="col-xs-6">
        <h2 class="noBorder"><span>What People Think</span></h2>
      </div>
      <div class="col-xs-3"><span class="borderBtm"></span></div>
    </div>
    <div class="row"> 
      
      <!-- <h2 class="padT6px"><span class="testiBG">What People Think</span></h2> -->
      
      <div class="col-sm-2">
        <p><i class="fa fa-quote-left" aria-hidden="true"></i></p>
      </div>
      <div class="col-sm-8">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.<span><strong>Magda Guzman</strong><br>
          Business owner<br>
          Hacienda Las Americas</span></p>
      </div>
      <div class="col-sm-2"></div>
    </div>
  </div>
</section>
        
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Send Message</h4>
      </div>
      <div class="modal-body">
       {!! Form::open(['route' => 'messages.storefrontend','class'=>'form-horizontal','role'=>'form']) !!}
                  
                    
                        <input type="hidden" name="subject" class="form-control" 
                        id="subject" placeholder="subject" value="{!! $ad->id !!}" />
                    
                  <div class="form-group">
                    <label class="col-sm-2 control-label"
                          for="inputPassword3" >message</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="message" 
                            id="message" placeholder="message"></textarea>
                    </div>
                  </div>
                   @if($users->count() > 0)
                   
                        @foreach($users as $user)
                            <input type="hidden" name="recipients[]" value="{{ $user->id }}">{!!$user->name!!}
                        @endforeach
                   
                    @endif
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-default">Send</button>
                    </div>
                  </div>
                </form>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>
       
 

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
