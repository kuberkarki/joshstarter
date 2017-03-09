@extends('layouts/eventday')

{{-- Page title --}}
@section('title')
Search Ads
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@stop




{{-- Page content --}}
@section('content')
    <!-- Container Section Strat -->
<section class="mainContainer">
<div class="contantWrapper innercontantWrapper adsPage">
  <div class="container globalWrap">
      <div class="row">
      <div class="col-sm-3">
        <div class="leftContent">
          <div class="leftList">
            <h3>Main Catagory</h3>
            <ul>
            @if($ads_category)
              @foreach($ads_category as $cat)
                <li><a href="{!! url('list-ads',$cat->slug) !!}">{!! $cat->name !!}</a></li>
              @endforeach
            @endif
              
            </ul>
          </div>

          <div class="leftList">
            <h3>Filter on Availability</h3>
            <div class="row">
              <div class="col-sm-5"><div class="input-group">
                      <input name="fromdate" type="text" id='datepicker1' placeholder="Date"  class="form-control" placeholder="Date" onchange="filterbydate()" aria-describedby="basic-addon1">
                    </div></div>
              <div class="col-sm-2 txtCntr">To</div>
              <div class="col-sm-5"><div class="input-group">
                      <input name="todate" type="text" id='datepicker2' placeholder="Date"  class="form-control" placeholder="Date" onchange="filterbydate()" aria-describedby="basic-addon1">
                    </div></div>
            </div>
          </div>

          <div class="leftList">
            <h3>Filter on Rating</h3>
            <ul>
              <li><a href="{{Request::url()}}?rating=5"><div class="rating"><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i></div><span class="review"></span></a></li>
              <li><a href="{{Request::url()}}?rating=4"><div class="rating"><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i></div><span class="review"></span></a></li>
              <li><a href="{{Request::url()}}?rating=3"><div class="rating"><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i></div><span class="review"></span></a></li>
              <li><a href="{{Request::url()}}?rating=2"><div class="rating"><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i></div><span class="review"></span></a></li>
              <li><a href="{{Request::url()}}?rating=1"><div class="rating"><i class="fa fa-star" aria-hidden="true"></i></div><span class="review"></span></a></li>
            </ul>
          </div>

          <div class="leftList">
            <h3>Filter on Price</h3>
            <ul>
              <li><a href="{{Request::url()}}?price=0-100">{{Helper::getPricesymbol()}} 0 - {{Helper::getPricesymbol()}} 100</a></li>
              <li><a href="{{Request::url()}}?price=100-1000">{{Helper::getPricesymbol()}} 100 - {{Helper::getPricesymbol()}} 1000</a></li>
              <li><a href="{{Request::url()}}?price=1000-5000">{{Helper::getPricesymbol()}} 1000 - {{Helper::getPricesymbol()}} 5000</a></li>
              <li><a href="{{Request::url()}}?price=5001-inf">Over {{Helper::getPricesymbol()}} 5000</a></li>
            </ul>
          </div>
          
         
        </div>
      </div>
      <div class="col-sm-9">
        <div class="innerAds"><img src="{{asset('assets/images/eventday/innerads.jpg')}}" class="img-responsive"></div>
        <div class="row innerEventList">
        {!! Form::open(['url' => 'search']) !!}
              <div class="row">

                <div class="col-md-6 col-sm-6 col-xs-12 five-three">
                  <div class="row">
                    <div class="col-md-5 col-sm-5 col-xs-12">
                    
                   <label><input type="radio" value='business' name="type" {{ !$iseventsearch?"checked":""}} /> Business Search</label>
                   <label><input type="radio" value='event' name="type" {{ $iseventsearch?"checked":""}} /> Events Search</label>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                    
                    <div class="input-group">
                      <input type="text" class="form-control" placeholder="Enter Your keyword" aria-describedby="basic-addon1" name="keyword" value="{!! old('query',$query) !!}">
                    </div>

                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-12">
                    
                  <div class="input-group">
                      <input type="text" name="location" class="form-control" placeholder="Location" aria-describedby="basic-addon1" value="{{$location}}">
                    </div>
                    </div><!-- end inner row -->
                  </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12 five-two">
                  <div class="row">
                    <div class="col-md-7 col-sm-7 col-xs-12">
                      <div class="input-group">
                      <input type="text" class="form-control" id="datepicker" name="date" placeholder="Date" aria-describedby="basic-addon1" value={{$date}}>
                      <span class="input-group-addon" id="basic-addon2"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                    </div>
                    </div>
                    <div class="col-md-5 col-sm-5 col-xs-12">
                      <button type="submit" class="btn btn-secondary searchBtn">Search</button>
                     
                    </div>
                  </div><!-- end inner row -->
                </div>
              </div><!-- end outer row -->
              {!! Form::close() !!}
        <h2>Search Reasults for '{!! $query !!}'</h2>
        @if($isbusinesssearch)
            @if(count($ads))
            @foreach($ads as $ad)
              <div class="col-sm-4">
                <div class="panel panel-default">
                  <a href="{!! url('ads/details',$ad->slug) !!}">
                    <div class="panel-image">
                      <div class="sal_price"> 
                        @if($ad->price_type=='Fixed')
                          {!! Helper::getPrice($ad->price) !!}
                        @elseif(count($ad->prices()->first()))
                          Min {!! Helper::getPrice($ad->prices()->first()->price) !!}
                        @endif
                      </div>
                      @if($ad->photo)
                            <img src="{{ URL::to('/thumbnail/'.$ad->photo)  }}" class="img-responsive img-hove" alt="{!! $ad->title !!}">
                      @else
                        <img class="img-responsive img-hover" src="{{asset('assets/images/eventday/post1.jpg')}}" alt="{!! $ad->title !!}">
                      @endif
                      </div>
                      </a>
                      <div class="panel-body">
                      <a href="{!! url('ads/details',$ad->slug) !!}"><h3>{!! $ad->title !!} </h3></a><br/>
                    <ul class="ratingAds">
                      <li>
                     
                        <div data="{!! $ad->id !!}" id="stars" class="stars starrr rating" data-rating='{!! (int)$ad->averagerating !!}' data-logged="{{Sentinel::check()?true:false}}"></div>
                      
                      <!-- <div class="rating"><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i></div> -->
                      <span class="review">(<span id="total-{!! $ad->id!!}">{!! count($ad->ratings) !!}</span>)</span></li>
                    </ul>
                    <a href="{!! url('ads/details',$ad->slug) !!}">
                      <div class="date">{{--$ad->created_at->diffForHumans()--}}</div>
                      <div class="address"><i class="fa fa-map-marker" aria-hidden="true"></i> {!! $ad->location !!}</div>
                      <!-- <div class="time"> <i class="fa fa-clock-o" aria-hidden="true"></i> Fri, May 6, 10pm</div> -->
                         <!--  <p>{!! str_limit($ad->description,150, '...') !!}</p> -->
                    </div>
                    </a>


                <div class="navPhotoVideo">
                  <a href="{!! url('ads/details',$ad->slug) !!}">More Detail</a><a href="#">Photo</a><a href="#">Video</a>
                </div>
                <div class="adsThumnelButton"><a href="{{ url('ads/details',$ad->slug)}}?booknow=true" class="btn btn-primary">Book Now</a></div>
                </div>
              </div>
            @endforeach
            @else
              <h2>No Ads in List</h2>
            @endif
                @if(count($ads))
                @include('pagination.default', ['paginator' => $ads])
                @endif
          @elseif($iseventsearch)
          @if(count($events))
            @foreach($events as $event)
              <div class="col-sm-4">
                <div class="panel panel-default">
                  <a href="{!! url('event',$event->slug) !!}">
                    <div class="panel-image">
                      <div class="sal_price"> 
                       
                          {!! Helper::getPrice($event->ticket_price) !!}
                        
                      </div>
                      @if($event->photo)
                            <img src="{{ URL::to('/thumbnail/'.$event->photo)  }}" class="img-responsive img-hove" alt="{!! $event->title !!}">
                      @else
                        <img class="img-responsive img-hover" src="{{asset('assets/images/eventday/post1.jpg')}}" alt="{!! $event->name !!}">
                      @endif
                      </div>
                      </a>
                      <div class="panel-body">
                      <a href="{!! url('event',$event->slug) !!}"><h3>{!! $event->name !!} </h3></a><br/>
                    <ul class="ratingAds">
                      <li>
                     
                        <div data="{!! $event->id !!}" id="stars" class="stars starrr rating" data-rating='{!! (int)$event->averagerating !!}' data-logged="{{Sentinel::check()?true:false}}"></div>
                      
                      <!-- <div class="rating"><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i></div> -->
                      <span class="review">(<span id="total-{!! $event->id!!}">{!! count($event->ratings) !!}</span>)</span></li>
                    </ul>
                    <a href="{!! url('event',$event->slug) !!}">
                      <div class="date">{{--$event->created_at->diffForHumans()--}}</div>
                      <div class="address"><i class="fa fa-map-marker" aria-hidden="true"></i> {!! $event->location !!}</div>
                      <!-- <div class="time"> <i class="fa fa-clock-o" aria-hidden="true"></i> Fri, May 6, 10pm</div> -->
                         <!--  <p>{!! str_limit($event->description,150, '...') !!}</p> -->
                    </div>
                    </a>


                <div class="navPhotoVideo">
                  <a href="{!! url('event',$event->slug) !!}">More Detail</a><a href="#">Photo</a><a href="#">Video</a>
                </div>
                <div class="adsThumnelButton"><a href="{{ url('event',$event->slug)}}?booknow=true" class="btn btn-primary">Book Now</a></div>
                </div>
              </div>
            @endforeach
            @else
              <h2>No Events in List</h2>
            @endif
                @if(count($events))
                @include('pagination.default', ['paginator' => $events])
                @endif
          @else
          @endif

          
        </div>
      </div>
      </div>
  </div>
    
</div>
</section>

@stop
{{-- page level scripts --}}
@section('footer_scripts')
<script src="{{ asset('assets/js/eventday/stars.js') }}" type="text/javascript"></script>
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
    <script src="{{ asset('assets/js/eventday/moment.js') }}"></script>
    <script>
    $( function() {
    $( "#datepicker" ).datepicker({dateFormat: 'yy-mm-dd'});
  } );
    </script>
<script>


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
    //alert(adid)
    $.ajax({
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
          });
  });
  
  $('#stars-existing').on('starrr:change', function(e, value){
    //$('#count-existing').html(value);
  });
});

  $( function() {
    var date = new Date();
        date.setMonth(date.getMonth()+1);
    $( "#datepicker1" ).datepicker(
      {
        dateFormat: 'yy-mm-dd',
        minDate: 0,
        maxDate:date
    });
     $( "#datepicker2" ).datepicker({dateFormat: 'yy-mm-dd',minDate: 0,maxDate:date});
  } );



</script>

@stop