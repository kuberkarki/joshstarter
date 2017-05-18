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
<script
   src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCq0JqsNGNj54cF3Sb3FMNq3fPbdnpzZ2M"></script>
<!--end of page level css-->
@stop
{{-- Page content --}}
@section('content')
<link href="{{ asset('assets/css/eventday/calendar.css') }}" rel="stylesheet">
<!-- Container Section Start -->
<section class="mainContainer">
   <div class="contantWrapper innercontantWrapper customerEvent">
   <div class="container globalWrap">
      <div class="row">
         <div class="col-sm-8">
            <div  class="row">
               <div class="col-sm-10">
                  <ul class="event-list">
                     <li>
                        <div class="info">
                           <h2 class="title">{{$ad->title}} </h2>
                           <div class="desc"><i class="fa fa-map-marker" aria-hidden="true"></i>  {!! $ad->location !!}
                            <div class="rating">
                                            <i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="price-text-color fa fa-star"></i><i class="price-text-color fa fa-star">
                                            </i><i class="fa fa-star"></i>
                                        </div>
                                        <div class="topReview"> Reviews (<strong class="colorRed">{!! count($ad->reviews()->get()) !!}</strong>)</div>
                                        </div>
                        </div>
                     </li>
                  </ul>
               </div>
               <div class="col-sm-2 mt1px">
                  <a type="button" data-toggle="modal" data-target="#bookModal" class="btn btn-secondary searchBtn">Book Now</a>
               </div>
            </div>
         </div>
         <div class="col-sm-4 mt1px">
            <button  class="btn btn-primary pullright" data-toggle="modal" data-target="#myModal">Send Message</button>
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
               <div class="customerGallery" >
                  <div id="gallery" >
                     @if(count($ad->photos()))
                     @foreach($ad->photos()->get() as $photo)            
                     <img alt="Preview Image 1"
                        src="{{ URL::to('/thumbnail/'.$photo->photo)  }}"
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
                           <a href="{{ $share['facebook'] }}"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
                           <a href="{{ $share['twitter'] }}"><i class="fa fa-twitter-square" aria-hidden="true"></i></a>
                           <a href="{{ $share['pinterest'] }}"><i class="fa fa-pinterest-square" aria-hidden="true"></i></a>
                           <a href="{{ $share['email'] }}"><i class="fa fa-envelope-square" aria-hidden="true"></i></a>
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="favBox pull-right">
                           <a href="{{ route('view_counter.like', array('class_name' => 'Ad', 'object_id' => $ad->id)) }}"  class="btn btn-secondary"><i class="fa fa-heart-o" aria-hidden="true"></i> ({{ $ad->likes_count() }}) Likes</a>
                           <!--  {{-- route('view_counter.like', array('class_name' => 'Ad', 'object_id' => $ad->id)) }}
                              {{ route('view_counter.unlike', array('class_name' => 'Ad', 'object_id' => $ad->id)) --}} -->
                        </div>
                     </div>
                  </div>
               </div>
               <!-- <div class="latestUpdate">
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
                  </div> -->
               <div class="reviewSection">
                  <div class="headingCustomerPara">Reviews( {!! count($ad->reviews()->get()) !!} )</div>
                  <ul class="media-list">
                     @foreach($ad->reviews()->get() as $review)
                     <div class="row">
                        @for($i=1;$i<=5;$i++)
                        @if($review->rating>=$i)
                        <span class="glyphicon glyphicon-star"></span>
                        @else
                        <span class="glyphicon glyphicon-star-empty"></span>
                        @endif
                        @endfor
                        {{-- */$user=App\user::find($review->author_id);/* --}}
                        {!! $user->first_name  ." ".$user->last_name !!} 
                        <span class="pull-right">
                        {!! $review->updated_at->diffForHumans() !!}
                        </span> 
                        <p>{!! $review->body !!}</p>
                     </div>
                     @endforeach
                  </ul>
                  @if(!$reviewed)
                  <h3>Leave a Review</h3>
                  {!! Form::open(array('url' => URL::to('submit-review'), 'method' => 'post', 'class' => 'bf', 'id'=>'frmreview' ,'files'=> true)) !!}
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
            <div class="eventLogoWrap"><div class="eventlogo"><img class="img-responsive img-circle" src="{{url('user_circularthumb',$owner->pic)}}"/></div></div>
               <div class="leftList">
                  <h3>Business Owner</h3>
                  @if($owner->company_name)
                  {{$owner->company_name}}
                  @elseif($owner->first_name)
                  {{$owner->first_name." ".$owner->last_name}}
                  @elseif($owner->name)
                  {{$owner->name}}
                  @endif
                  @if($owner->pic)
                  <img src="{!! url('/').'/user_circularthumb/'.$owner->pic !!}" alt="profile pic" class="img-responsive">
                  @else
                  <img src="{{ asset('assets/img/authors/avatar3.jpg') }}" alt="profile pic">
                  @endif
                  @if($ad->owner()->first()->bio)
                  <p>
                     {!! $ad->owner()->first()->bio !!}<br>
                     @endif
                     @if($owner->office_phone)
                     <i class="fa fa-phone" aria-hidden="true"></i> {!! $owner->office_phone !!}<br>
                     @endif
                     <!-- <i class="fa fa-globe" aria-hidden="true"></i> www.event.com<br> -->
                     @if($owner->address)
                     <i class="fa fa-map-marker" aria-hidden="true"></i> {!! $owner->address !!}<br>
                     @endif
                     <!-- <h3>Rating</h3>
                        <ul>
                          <li><div class="rating"><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i></div><span class="review">(23)</span></li>
                        </ul> -->

<!-- left Discription 4-9-2017 -->
<br>
          <div class="row">
            <div class="col-sm-7">              
            <h3>Business Name:</h3>
            <p>Wedding planner Ltd</p>
            <p>Location: 12Oman Avenue,</p>
            <p>Cricklewood, United Kingdom</p>
            <p>NW2</p>
            <p><i class="fa fa-phone" aria-hidden="true"></i> Tel:02070543546</p>

            </div>
            <div class="col-sm-5">
            <div class="reviewP"> 90% positive review</div>
            
              <div class="customerSocial">
              <a href="#"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
              <a href="#"><i class="fa fa-twitter-square" aria-hidden="true"></i></a>
              <a href="#"><i class="fa fa-pinterest-square" aria-hidden="true"></i></a>
              <a href="#"><i class="fa fa-envelope-square" aria-hidden="true"></i></a>
            </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
            <p class="shortDisc">Short Descrition:</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
            </div>
          </div>
          <!-- left Discription 4-9-2017 -->
               </div>
            </div>
            <div class="leftContent">
               <div class="leftList">
                  <h3>Location</h3>
                  <!-- <img src="{{asset('assets/images/eventday/maps.jpg')}}" class="img-responsive"> -->
                  <div id="map" style="width:100%; height:100px;">
                  </div>
               </div>
               
               <!--  <div class="leftContent">
                  <div class="leftList">
                    <img src="{{asset('assets/images/eventday/customerads1.jpg')}}" class="img-responsive">
                  </div>
                  </div> -->
            </div>
               <div class="leftContent">
                  <div class="leftList">
                     <h3>Ads List</h3>
                     <!-- <img src="{{asset('assets/images/eventday/sponsor1.jpg')}}" class="img-responsive"> -->
  <div class="row">
    <div class="col-md-12">
      <div class="carousel carousel-showmanymoveone slide" id="carousel123">
        <div class="carousel-inner">
          <div class="item active">
            <div class="col-xs-12 col-sm-6 col-md-3"><a href="#"><img src="http://placehold.it/500/0054A6/fff/&amp;text=1" class="img-responsive"></a></div>
          </div>
          <div class="item">
            <div class="col-xs-12 col-sm-6 col-md-3"><a href="#"><img src="http://placehold.it/500/002d5a/fff/&amp;text=2" class="img-responsive"></a></div>
          </div>
          <div class="item">
            <div class="col-xs-12 col-sm-6 col-md-3"><a href="#"><img src="http://placehold.it/500/d6d6d6/333&amp;text=3" class="img-responsive"></a></div>
          </div>          
          <div class="item">
            <div class="col-xs-12 col-sm-6 col-md-3"><a href="#"><img src="http://placehold.it/500/002040/eeeeee&amp;text=4" class="img-responsive"></a></div>
          </div>
          <div class="item">
            <div class="col-xs-12 col-sm-6 col-md-3"><a href="#"><img src="http://placehold.it/500/0054A6/fff/&amp;text=5" class="img-responsive"></a></div>
          </div>
          <div class="item">
            <div class="col-xs-12 col-sm-6 col-md-3"><a href="#"><img src="http://placehold.it/500/002d5a/fff/&amp;text=6" class="img-responsive"></a></div>
          </div>
          <div class="item">
            <div class="col-xs-12 col-sm-6 col-md-3"><a href="#"><img src="http://placehold.it/500/eeeeee&amp;text=7" class="img-responsive"></a></div>
          </div>
          <div class="item">
            <div class="col-xs-12 col-sm-6 col-md-3"><a href="#"><img src="http://placehold.it/500/40a1ff/002040&amp;text=8" class="img-responsive"></a></div>
          </div>
        </div>
        <a class="left carousel-control" href="#carousel123" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
        <a class="right carousel-control" href="#carousel123" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
      </div>
    </div>
  </div> 



                     </div>
               </div>

               <div class="leftContent">
                  <div class="leftList">
                     <h3>Google Ads Banner</h3>
                     <div class="googleBanner">Google Ads Banner</div>
                     </div>
               </div>
            <div class="leftContent">
                  <div class="leftList otherEvent">
                     <h3>Other {!! $ads_category[$ad->ads_category_id] !!}</h3>
                     @if(count($otherads))
                     @foreach($otherads as $other)
                     <p><a href="{{ URL::to('ads/details',$other->slug)}}"><span class="otherEventTitle">{{ $other->title}}</span>
                        {{ str_limit($other->description,40,'...')}}</a>
                     </p>
                     @endforeach
                     @endif
                     <!-- <p><a href="#"><span class="otherEventTitle">Wedding venue NYC(New York, NY)</span>
                        sed do eiusmod tempor incididunt ut labore et dolore...</a></p>
                                    <p><a href="#"><span class="otherEventTitle">Wedding venue NYC(New York, NY)</span>
                        sed do eiusmod tempor incididunt ut labore et dolore...</a></p>
                                    <p><a href="#"><span class="otherEventTitle">Wedding venue NYC(New York, NY)</span>
                        sed do eiusmod tempor incididunt ut labore et dolore...</a></p>
                                    <p><a href="#"><span class="otherEventTitle">Wedding venue NYC(New York, NY)</span>
                        sed do eiusmod tempor incididunt ut labore et dolore...</a></p> -->
                  </div>
               </div>
         </div>
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
<div class="modal fade" id="bookModal" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
            <h4 class="modal-title custom_align" id="Heading">Select a Date</h4>
         </div>
         <div class="modal-body">
            <h1>Loading...</h1>
         </div>
         <div class="modal-footer ">
            <div class="alert alert-warning hide seldateerr">
               <strong>Warning!</strong> Date not selected.
            </div>
            <button id="booknow" type="button" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span>Book Now</button>
         </div>
      </div>
      <!-- /.modal-content --> 
   </div>
   <!-- /.modal-dialog --> 
</div>
@stop
{{-- page level scripts --}}
@section('footer_scripts')
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script src="{{ asset('assets/js/eventday/stars.js') }}" type="text/javascript"></script>
<script>
   $(function() {
     return $(".starrr").starrr();
   });
   
   $( document ).ready(function() {
     $.urlParam = function(name){
         var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
         if (results==null){
            return null;
         }
         else{
            return results[1] || 0;
         }
     }
   
   
   
     $( "#frmreview" ).submit(function( event ) {
         
         if($('#rate').val()==''){
           alert('Please Rate');
           return false;
         }
   
       });
   
     $("#bookModal").on("show.bs.modal", function(e) {
             //alert(selected_date)
               var link = $(e.relatedTarget);
                $(".seldateerr").addClass('hide');
               $(this).find(".modal-body").load('{{ url('ads/ajax-booking-detail')}}/{{$ad->id}}');
           });
   
     $('#booknow').click(function(e){
         //e.preventDefault();
         //alert($('#dates').val());
   
         if($('#dates').val()==''){
           //alert('Date Not Selected')
           //
           $(".seldateerr").removeClass('hide');
           
            return false;
         }
   
         $('#frmbook').submit();
         /*
         $.post('http://path/to/post', 
            $('#myForm').serialize(), 
            function(data, status, xhr){
              // do something here with response;
            });
         */
   });
   
     
     if($.urlParam('booknow')=='true')
      $('#bookModal').modal('show');
   });
</script>
@if($ad->location)
<script type="text/javascript">
   var geocoder;
   var map;
   var address = "{{ $ad->location}}";
   
   function initialize() {
     geocoder = new google.maps.Geocoder();
     var latlng = new google.maps.LatLng(-34.397, 150.644);
     var myOptions = {
       zoom: 8,
       center: latlng,
       mapTypeControl: true,
       mapTypeControlOptions: {
         style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
       },
       navigationControl: true,
       mapTypeId: google.maps.MapTypeId.ROADMAP
     };
     map = new google.maps.Map(document.getElementById("map"), myOptions);
     if (geocoder) {
       geocoder.geocode({
         'address': address
       }, function(results, status) {
         if (status == google.maps.GeocoderStatus.OK) {
           if (status != google.maps.GeocoderStatus.ZERO_RESULTS) {
             map.setCenter(results[0].geometry.location);
   
             var infowindow = new google.maps.InfoWindow({
               content: '<b>' + address + '</b>',
               size: new google.maps.Size(150, 50)
             });
   
             var marker = new google.maps.Marker({
               position: results[0].geometry.location,
               map: map,
               title: address
             });
             google.maps.event.addListener(marker, 'click', function() {
               infowindow.open(map, marker);
             });
   
           } else {
             alert("No results found");
           }
         } else {
           alert("Geocode was not successful for the following reason: " + status);
         }
       });
     }
   }
   google.maps.event.addDomListener(window, 'load', initialize);
</script>
<!-- Carousel -->
<script type="text/javascript">
   (function(){
  // setup your carousels as you normally would using JS
  // or via data attributes according to the documentation
  // http://getbootstrap.com/javascript/#carousel
  $('#carousel123').carousel({ interval: 2000 });
  $('#carouselABC').carousel({ interval: 3600 });
}());

(function(){
  $('.carousel-showmanymoveone .item').each(function(){
    var itemToClone = $(this);

    for (var i=1;i<4;i++) {
      itemToClone = itemToClone.next();

      // wrap around if at end of item collection
      if (!itemToClone.length) {
        itemToClone = $(this).siblings(':first');
      }

      // grab item, clone, add marker class, add to collection
      itemToClone.children(':first-child').clone()
        .addClass("cloneditem-"+(i))
        .appendTo($(this));
    }
  });
}());

</script>
<!-- Carousel -->
@endif
@stop