@extends('layouts/eventday')

{{-- Page title --}}
@section('title')
{{$event->name}}
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <!--page level css starts-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/blog.css') }}">
    <!--end of page level css-->
    <script
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCq0JqsNGNj54cF3Sb3FMNq3fPbdnpzZ2M">
</script>
@stop

{{-- breadcrumb --}}
@section('top')
    <div class="breadcum">
        <div class="container">
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('home') }}"> <i class="livicon icon3 icon4" data-name="home" data-size="18" data-loop="true" data-c="#3d3d3d" data-hc="#3d3d3d"></i>Dashboard
                    </a>
                </li>
                <li class="hidden-xs">
                    <i class="livicon icon3" data-name="angle-double-right" data-size="18" data-loop="true" data-c="#01bc8c" data-hc="#01bc8c"></i>
                    <a href="#">event</a>
                </li>
            </ol>
            <!-- <div class="pull-right">
                <i class="livicon icon3" data-name="doc-landscape" data-size="20" data-loop="true" data-c="#3d3d3d" data-hc="#3d3d3d"></i> {{$event->title}}
            </div> -->
        </div>
    </div>
    @stop


{{-- Page content --}}
@section('content')
    <!-- Container Section Start -->
    <div class="container">
        <h2 class="primary marl12">{{$event->name}}</h2>
        <div class="row content">
        @include('notifications')
            <!-- Business Deal Section Start -->
            <div class="col-sm-8 col-md-8">
                <div class=" thumbnail featured-post-wide img">
                <div class="sal_price"> 
                       
                         Price: {!! Helper::getPrice($event->ticket_price) !!}
                        
                      </div>
                    @if($event->photo)
                        <img src="{{ URL::to('/uploads/crudfiles/'.$event->photo)  }}" class="img-responsive" alt="Image">
                    @endif
                    <!-- /.event-detail-image -->
                    <div class="the-box no-border event-detail-content">
    

                        <p class="additional-post-wrap">
                            <span class="additional-post">
                              <div class="address"><i class="fa fa-map-marker" aria-hidden="true"></i> {!! $event->location !!}</div>     
                            </span>
                            <span class="additional-post">
                                    <i class="fa fa-clock-o" aria-hidden="true"></i> 
              
              {!! date('D, M d, g a ',strtotime($event->date)) !!}
                                </span>
                            <span class="additional-post">
                                    
                                </span>
                        </p>
                        <p class="text-justify">
                            {!! $event->description !!}
                        </p>
                        @if($event->video_link)
                        <p class="center" style="text-align: center;">

                        @if(str_contains($event->video_link, 'vimeo.com'))
                          {!! preg_replace('#http(s)?://(www\.)?(player\.)?vimeo\.com/(video/)?(\d+)#',
                             "<iframe width=\"420\" height=\"315\" src=\"//player.vimeo.com/video/$5\" frameborder=\"0\" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>",
                             $event->video_link) !!}
                           @endif
                        @if(str_contains($event->video_link, 'youtube.com'))
                           {!!  preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","<iframe width=\"420\" height=\"315\" src=\"//www.youtube.com/embed/$1\" frameborder=\"0\" allowfullscreen></iframe>",$event->video_link)!!}
                        @endif
                        </p>
                        @endif
                        <p>
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
                              <div class="favBox pull-right"><a href="{{ route('view_counter.like', array('class_name' => 'Event', 'object_id' => $event->id)) }}"  class="btn btn-secondary"><i class="fa fa-heart-o" aria-hidden="true"></i> ({{ $event->likes_count()?$event->likes_count():0 }}) Likes</a>

                              
                             <!--  {{-- route('view_counter.like', array('class_name' => 'Ad', 'object_id' => $ad->id)) }}
                {{ route('view_counter.unlike', array('class_name' => 'Ad', 'object_id' => $ad->id)) --}} --></div>
                            </div>
                          </div>
                        </div>
                        </p>
                        <p class="pull-right">
                            <?php if(isset($user)){?>
                         <button  class="btn btn-primary" data-toggle="modal" data-target="#myModal">Send Message</button> 
                            <?php } else{
                                
                                /*<a href="{{url('login')}}">Login to Send Message</a> */
                               
                                }?>
                        <a href="{{ url('events/book',$event->id) }}" ><i class="fa fa-ticket" aria-hidden="true" ></i> Book Tickets</a>
                        </p>
                        <!-- <p>
                            <strong>Tags: </strong>
                            @forelse($event->tags as $tag)
                                <a href="{{ URL::to('event/'.mb_strtolower($tag).'/tag') }}">{{ $tag }}</a>,
                            @empty
                                No Tags
                            @endforelse
                        </p> -->
                    </div>
                </div>
                @if(isset($user))
                <div class="reviewSection">
                    <div class="headingCustomerPara">Reviews( {!! count($event->reviews()->get()) !!} )</div>
                      <ul class="media-list">
                        @foreach($event->reviews()->get() as $review)
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
                                        {!! $user->first_name  ." ".$user->last_name !!} 
                                        <span class="pull-right">
                                        {!! $review->updated_at->diffForHumans() !!}
                                        </span> 
                        
                                <p>{!! $review->body !!}</p>
                              </div>
                           </div>
                        
                        @endforeach
              </ul>
                @if(!$reviewed)
                <h3>Leave a Review</h3>
                {!! Form::open(array('url' => URL::to('submit-review-event'), 'method' => 'post', 'class' => 'bf', 'id'=>'frmreview' ,'files'=> true)) !!}
              @else
                <h3>Review again</h3>
                {!! Form::open(array('url' => URL::to('submit-review-event-again'), 'method' => 'post', 'class' => 'bf', 'id'=>'frm' ,'files'=> true)) !!}
                <input type="hidden" name="review_id" value="{!! $reviewed->id !!}">
              @endif
              <input type="hidden" name="id" value="{!! $event->id !!}">

              <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                  {!! Form::text('title', null, array('class' => 'form-control input-lg','required' => 'required', 'placeholder'=>'Title')) !!}
                  <span class="help-block">{{ $errors->first('title', ':message') }}</span>
              </div>
              
              <div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
                  {!! Form::textarea('body', null, array('class' => 'form-control input-lg no-resize','required' => 'required', 'style'=>'height: 200px', 'placeholder'=>'Your review')) !!}
                  <span class="help-block">{{ $errors->first('body', ':message') }}</span>
              </div>
              <div class="form-group ratingAds">
                  <div data="{!! $event->id !!}" id="stars" class="stars starrr rating" data-logged="{{Sentinel::check()?true:false}}"></div>
                  <input type="hidden" name="rate" id="rate" />
              </div>
              <div class="form-group">
                  <button type="submit" class="btn btn-success btn-md"><i class="fa fa-comment"></i>
                      Submit
                  </button>
              </div>
              {!! Form::close() !!}
              </div>

              @endif
                <!-- Media left section start -->
                <h3 class="comments">{{$event->comments->count()}} Comments</h3><br />
                <ul class="media-list">
                    @foreach($event->comments as $comment)
                    <li class="media">
                        <div class="media-body">
                            <h4 class="media-heading"><i>{{$comment->name}}</i></h4>
                            <p>{{$comment->comment}}</p>
                            <p class="text-danger">
                                <small> {!! $comment->created_at!!}</small>
                            </p>
                        </div>
                    </li>
                    @endforeach
                </ul>
                <!-- //Media left section End -->
                <!-- Comment Section Start -->
                <h3 id="comment">Leave a Comment</h3>
                {!! Form::open(array('url' => URL::to('event/'.$event->slug.'/comment'), 'method' => 'post', 'class' => 'bf', 'files'=> true)) !!}

                <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                    {!! Form::text('name', null, array('class' => 'form-control input-lg','required' => 'required', 'placeholder'=>'Your name')) !!}
                    <span class="help-block">{{ $errors->first('name', ':message') }}</span>
                </div>
                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                    {!! Form::text('email', null, array('class' => 'form-control input-lg','required' => 'required', 'placeholder'=>'Your email')) !!}
                    <span class="help-block">{{ $errors->first('email', ':message') }}</span>
                </div>
                <div class="form-group {{ $errors->has('website') ? 'has-error' : '' }}">
                    {!! Form::text('website', null, array('class' => 'form-control input-lg', 'placeholder'=>'Your website')) !!}
                    <span class="help-block">{{ $errors->first('website', ':message') }}</span>
                </div>
                <div class="form-group {{ $errors->has('comment') ? 'has-error' : '' }}">
                    {!! Form::textarea('comment', null, array('class' => 'form-control input-lg no-resize','required' => 'required', 'style'=>'height: 200px', 'placeholder'=>'Your comment')) !!}
                    <span class="help-block">{{ $errors->first('comment', ':message') }}</span>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-success btn-md"><i class="fa fa-comment"></i>
                        Submit
                    </button>
                </div>
                {!! Form::close() !!}
                <!-- //Comment Section End -->
                <!-- /the.box .no-border -->
                <!-- Media left section start -->
                
                <!-- //Media left section End -->
                <!-- Comment Section Start -->
                
                <!-- //Comment Section End -->
            </div>
            <!-- //Business Deal Section End -->
            <!-- /.col-sm-9 -->
            <!-- Recent Posts Section Start -->
            <div class="col-sm-4 col-md-4 col-full-width-left">
                <div class="the-box">
                    <div class="leftList">
                        <h3>Event Organizer</h3>
                         @if($owner->company_name)
                          {{$owner->company_name}}<br/>
                        
                        @elseif($owner->first_name)
                          {{$owner->first_name." ".$owner->last_name}}<br/>
                        
                        @elseif($owner->name)
                          {{$owner->name}}<br/>
                        @endif
                        @if($owner->pic)

                            <img src="{!! url('/').'/thumbnail2/'.$owner->pic !!}" alt="profile pic" class="img-responsive"><br/>
                        @else
                            <img src="{{ asset('assets/img/authors/avatar3.jpg') }}" alt="profile pic"><br/>
                        @endif
                        @if($owner->bio)
                        <p>{!! $owner->bio !!}</p><br>
                        @endif
                         @if($owner->office_phone)
                        <i class="fa fa-phone" aria-hidden="true"></i> {!! $owner->office_phone !!}<br>
                        @endif
                        <!-- <i class="fa fa-globe" aria-hidden="true"></i> www.event.com<br> -->
                        @if($owner->address)
                        <i class="fa fa-map-marker" aria-hidden="true"></i> {!! $owner->address !!}<br>
                        @endif
                        
                      
                  </div>
              </div>
              <div class="the-box">
                <div class="leftList">
                  <h3>Location</h3>
                  <div id="map" style="width:100%; height:300px;"></div>
                </div>
              </div>
                  <div class="the-box">
                        <h3 class="small-heading text-center">UPCOMING EVENTS</h3>
                        <ul class="media-list media-xs media-dotted">
                         @foreach($upcomingevents as $uevent)
                            <li class="media">
                                 @if($uevent->photo)
                                    <img class="img-responsive img-hover pull-left" src="../thumbnail3/{!! $uevent->photo !!}" alt="">
                                    @else
                                    <img class="img-responsive img-hover pull-left" src="../thumbnail3/lfgRuzbVrvzTfc2vwqnJ.jpg" alt="">
                                    @endif
                                <div class="media-body">
                                    <h4 class="media-heading primary">
                                                        <a href="{{ URL::to('event/'.$uevent->slug) }}">{!! $uevent->name !!}</a>
                                                    </h4>
                                    <p class="date">
                                        <small class="text-danger">{!! date('D, M d, g a ',strtotime($uevent->date)) !!}</small>
                                    </p>
                                    <p class="small">
                                       {!! str_limit($uevent->description,150, '...') !!}
                                    </p>
                                </div>
                            </li>
                            <hr>
                            @endforeach
                            
                        </ul>
                </div>
                <!-- /.the-box .bg-primary .no-border .text-center .no-margin -->
            </div>
            <!-- //Recent Posts Section End -->
            <!-- /.col-sm-3 -->
        </div>
    </div>
    <!-- //Conatainer Section End -->

<?php if(isset($user)){?>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Send Message</h4>
      </div>
      <div class="modal-body">
       {!! Form::open(['route' => 'messages.storefrontend-event','class'=>'form-horizontal','role'=>'form']) !!}
                  
                    
                        <input type="hidden" name="subject" class="form-control" 
                        id="subject" placeholder="subject" value="{!! $event->id !!}" />
                    
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


<?php } ?>

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
      $("#bookModal").on("show.bs.modal", function(e) {
          //alert(selected_date)
            var link = $(e.relatedTarget);
             $(".seldateerr").addClass('hide');
            $(this).find(".modal-body").load('{{ url('event/ajax-booking-detail')}}/{{$event->id}}');
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
@if($event->location)
<script type="text/javascript">
var geocoder;
var map;
var address = "{{ $event->location}}";

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
@endif
@stop
