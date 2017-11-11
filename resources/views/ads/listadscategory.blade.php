@extends('layouts/eventday')

{{-- Page title --}}
@section('title')
Ads category
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
            @foreach($ads_category as $cat)
              <li><a href="{!! url('list-ads',$cat->slug) !!}">{!! $cat->name !!}</a></li>
            @endforeach
              
            </ul>
          </div>

          

          

          
          
         
          
        </div>
      </div>
      <div class="col-sm-9">
        <div class="innerAds"><img src="{{asset('assets/images/eventday/innerads.jpg')}}" class="img-responsive"></div>
        <div class="row innerEventList">
        <ul>
            @foreach($ads_category as $cat)
              <li><a href="{!! url('list-ads',$cat->slug) !!}">{!! $cat->name !!}</a></li>
            @endforeach
              
            </ul>
          
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
<!-- <script src="{{ asset('assets/js/eventday/jquery.lazyload-any.min.js') }}" type="text/javascript"></script>
 -->
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


});

function filterbydate(){
    var from,to;
    from=$('#datepicker1').val();
    to=$('#datepicker2').val();
    if(from!='' && to!=''){
      window.location.href = "{{Request::url()}}?from="+from+'&to='+to;
    }
  }

    /*function load(img)
    {

      img.fadeIn(0, function() {
        img.fadeOut(1000);
      });
    }*/
    //$('.lazyload').lazyload({load: load});
  
</script>

@stop