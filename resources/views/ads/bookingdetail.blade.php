@extends('layouts/eventday')

{{-- Page title --}}
@section('title')
My Ads
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
   <!--  <link href="{{ asset('assets/css/eventday/calendar.css') }}" rel="stylesheet"> -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  
    <!--page level css starts-->
    <!--end of page level css-->
@stop




{{-- Page content --}}
@section('content')
<section class="" >
  <div class="contantWrapper innercontantWrapper">
    <div class="container">
      <div class="row">
            <div class="col-sm-12"><h3>Booking Details -> {{ $ad->title }}</h3></div>
            @include('business.usermenu')
           
            <div class="col-sm-9">
              @include('notifications')
            
            </div>
            
      </div>
      <div class="row">
      <div class="col-sm-6">
          Date: {{$date}}
          @if(isset($bookings->user))
            user:{{dd($bookings->user)}}
          @endif
          @if(isset($bookings->book_date))
            Bookings:{{dd($bookings)}}
          @else
            No Booking Registered
          @endif
        </div>

        
        
      </div>
    </div>
  </div>
</section>
@stop
@section('footer_scripts')
<script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script src="{{ asset('assets/js/eventday/moment.js') }}"></script>
<script>
var url = document.getElementById("url").textContent;
var jdays = [];
// Maintain array of dates
var dates = new Array();
var d;
//cDate = moment();
//$('#currentDate').text("Current Date is " + cDate.format("MMMM Do, YYYY") );

$(document).ready(function($){
  createCalendar();
});

/**
 * Instantiates the calendar AFTER ajax call
 */
function createCalendar() 
{
  $.get(url+"/api/get-appointments/{{$ad->id}}", function(data) {
    $.each(data, function(index, value) {
      jdays.push(value);
    });

    //My function to intialize the datepicker
    $('#calendar').datepicker({
      inline: true,
      //minDate: 0,
      dateFormat: 'yy-mm-dd',
      beforeShowDay: highlightDays,
      onSelect: getTimes,
    });
  });
}

/**
 * Highlights the days available for booking
 * @param  {datepicker date} date
 * @return {boolean, css}  
 */
function highlightDays(date)
{

//console.log(dates)
$('#dates').val(dates);
  date = moment(date).format('YYYY-MM-DD');
  var gotDate = jQuery.inArray(date, dates);
  for(var i = 0; i < jdays.length; i++) {
    jDate = moment(jdays[i]).format('YYYY-MM-DD');
    if(jDate == date) {
      return[true, "ui-state-highlight"];
    }

  }
  return false;
}

$('body').on('hidden.bs.modal', '.modal', function () {
  //$(this).removeData('bs.modal');
  var modalData = $(this).data('bs.modal');
  // Destroy modal if has remote source – don't want to destroy modals with static content.
  if (modalData && modalData.options.remote) {
    // Destroy component. Next time new component is created and loads fresh content
    $(this).removeData('bs.modal');
    // Also clear loaded content, otherwise it would flash before new one is loaded.
    $(this).find(".modal-content").empty();
    $(this).find(".modal-body").html();
  }
});

$("#bookModal").on("show.bs.modal", function(e) {
    $(this).removeData('bs.modal');
     // var timestamp= new Date(e.timeStamp);
     // console.log(timestamp)
     d=$('#date').val();
           // var $date=timestamp.getFullYear()+'-'+timestamp.getMonth()+'-'+timestamp.getDay();
        $(this).find(".modal-body").load('{{ url('ads/ajax-booking-management-detail')}}/{{$ad->id}}/'+d);
      });
/**
 * Gets times available for the day selected
 * Populates the daytimes id with dates available
 */
function getTimes(d)
{
  //alert(d);

$('#date').val(d);
  $('#bookModal').modal('show');
   //addOrRemoveDate(d);
  /*var dateSelected = moment(d);
  document.getElementById('daySelect').innerHTML = dateSelected.format("MMMM Do, YYYY");
  $.get(url+"/booking/times?selectedDay="+d, function(data) {
    $('#dayTimes').empty();
    $('#dayTimes').append('<h6>Times Available</h6>');
    for(var i in data) {
      var rdate = data[i].booking_datetime;
      rdate = rdate.split(" ");
      $("#dayTimes").append('<a href="'+url+'/booking/details/'+data[i].id+'">' + rdate[1] + '</a><br>');
    }
  });*/
}



function addDate(date) {
  alert(date)
    if (jQuery.inArray(date, dates) < 0) 
        dates.push(date);

}

function removeDate(index) {
    dates.splice(index, 1);
}

// Adds a date if we don't have it yet, else remove it
function addOrRemoveDate(date) {
    var index = jQuery.inArray(date, dates);
    if (index >= 0) 
        removeDate(index);
    else 
        addDate(date);
}

// Takes a 1-digit number and inserts a zero before it
function padNumber(number) {
    var ret = new String(number);
    if (ret.length == 1) 
        ret = "0" + ret;
    return ret;
}
$( function() {
    $( "#datepicker" ).datepicker({dateFormat: 'yy-mm-dd'});
  } );
</script>
@stop