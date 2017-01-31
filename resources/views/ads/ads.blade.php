@extends('layouts/eventday')

{{-- Page title --}}
@section('title')
My Ads
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
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
            @foreach($ads_category as $cat)
              <li><a href="{!! url('list-ads',$cat->slug) !!}">{!! $cat->name !!}</a></li>
            @endforeach
              
            </ul>
          </div>

          <div class="leftList">
            <h3>Filter on Availability</h3>
            <div class="row">
              <div class="col-sm-5"><div class="input-group">
                      <input type="text" class="form-control" placeholder="Date" aria-describedby="basic-addon1">
                    </div></div>
              <div class="col-sm-2 txtCntr">To</div>
              <div class="col-sm-5"><div class="input-group">
                      <input type="text" class="form-control" placeholder="Date" aria-describedby="basic-addon1">
                    </div></div>
            </div>
          </div>

          <div class="leftList">
            <h3>Filter on Rating</h3>
            <ul>
              <li><div class="rating"><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i></div><span class="review">(23)</span></li>
              <li><div class="rating"><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i></div><span class="review">(23)</span></li>
              <li><div class="rating"><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i></div><span class="review">(23)</span></li>
              <li><div class="rating"><i class="fa fa-star" aria-hidden="true"></i><i class="fa fa-star" aria-hidden="true"></i></div><span class="review">(23)</span></li>
              <li><div class="rating"><i class="fa fa-star" aria-hidden="true"></i></div><span class="review">(23)</span></li>
            </ul>
          </div>

          <div class="leftList">
            <h3>Filter on Price</h3>
            <ul>
              <li>0 - 100</li>
              <li>100 - 1000</li>
              <li>1000 - 5000</li>
              <li>Over 5000</li>
            </ul>
          </div>
          
          <div class="leftList">
            <h3>Filter on Discount</h3>
            <ul>
              <li>0 - 10% Sale</li>
              <li>10 - 20% Sale</li>
              <li>20 - 30% Sale</li>
              <li>30 - 40% Sale</li>
              <li>40 - 50% Sale</li>
              <li>50 - 60% Sale</li>
              <li>60 - 70% Sale</li>
              <li>70 - 80% Sale</li>
              <li>Above</li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-sm-9">
        <div class="innerAds"><img src="{{asset('assets/images/eventday/innerads.jpg')}}" class="img-responsive"></div>
        <div class="row innerEventList">
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
          
        </div>
                        @include('pagination.limit_links', ['paginator' => $ads])

      </div>
      </div>
  </div>
    <div class="container">
      <div class="newSetion">
        <div class="row">
          <div class="col-sm-4">
          <h3>latest News</h3>
          <p><a href="#"><strong> Lorem ipsum dolor </strong>
          <span> 10 May  1:10 am</span>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut 
          </a></p>

                    <p><a href="#"><strong> Lorem ipsum dolor </strong>
          <span> 10 May  1:10 am</span>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut 
          </a></p>

                    <p><a href="#"><strong> Lorem ipsum dolor </strong>
          <span> 10 May  1:10 am</span>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut 
          </a></p>

                    <p><a href="#"><strong> Lorem ipsum dolor </strong>
          <span> 10 May  1:10 am</span>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut 
          </a></p>

                    <p><a href="#"><strong> Lorem ipsum dolor </strong>
          <span> 10 May  1:10 am</span>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut 
          </a></p>

                    <p><a href="#"><strong> Lorem ipsum dolor </strong>
          <span> 10 May  1:10 am</span>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut 
          </a></p>
          </div>
          <div class="col-sm-4">
            <h3>Popular Events in London, UK</h3>
          <p><img src="images/news1.jpg" alt=""><a href="#"><strong> Lorem ipsum dolor </strong>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod 
          </a></p>
          <p><img src="images/news1.jpg" alt=""><a href="#"><strong> Lorem ipsum dolor </strong>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod 
          </a></p>
          <p><img src="images/news1.jpg" alt=""><a href="#"><strong> Lorem ipsum dolor </strong>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod 
          </a></p>
          <p><img src="images/news1.jpg" alt=""><a href="#"><strong> Lorem ipsum dolor </strong>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod 
          </a></p>
          <p><img src="images/news1.jpg" alt=""><a href="#"><strong> Lorem ipsum dolor </strong>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod 
          </a></p>
          <p><img src="images/news1.jpg" alt=""><a href="#"><strong> Lorem ipsum dolor </strong>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod 
          </a></p>
          </div>
          
          <div class="col-sm-4">
            <h3>Events Around the World</h3>
          <p><img src="images/news1.jpg" alt=""><a href="#"><strong> Lorem ipsum dolor </strong>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod 
          </a></p>
          <p><img src="images/news1.jpg" alt=""><a href="#"><strong> Lorem ipsum dolor </strong>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod 
          </a></p>
          <p><img src="images/news1.jpg" alt=""><a href="#"><strong> Lorem ipsum dolor </strong>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod 
          </a></p>
          <p><img src="images/news1.jpg" alt=""><a href="#"><strong> Lorem ipsum dolor </strong>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod 
          </a></p>
          <p><img src="images/news1.jpg" alt=""><a href="#"><strong> Lorem ipsum dolor </strong>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod 
          </a></p>
          <p><img src="images/news1.jpg" alt=""><a href="#"><strong> Lorem ipsum dolor </strong>
          Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod 
          </a></p>
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
@stop
{{-- page level scripts --}}
@section('footer_scripts')
<script src="{{ asset('assets/js/eventday/stars.js') }}" type="text/javascript"></script>

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
</script>

@stop