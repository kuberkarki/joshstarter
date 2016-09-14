<div id="url" style="display:none">{{ url('/')}}</div>
<div id="calendar"></div>
{{Form::open(array('url' => url('ads/book'),'id'=>'frmbook'))}}

 <input type="hidden" name="dates" id="dates" />
 <input type="hidden" name="id" value="{{$ad->id}}" />
 {{Form::close()}}
<script src="{{ asset('assets/js/eventday/moment.js') }}"></script>
<script>
var url = document.getElementById("url").textContent;
var jdays = [];
// Maintain array of dates
var dates = new Array();
cDate = moment();
$('#currentDate').text("Current Date is " + cDate.format("MMMM Do, YYYY") );

$(document).ready(function($){
  createCalendar();
});

/**
 * Instantiates the calendar AFTER ajax call
 */
function createCalendar() 
{
  $.get(url+"/api/get-available-days/{{$ad->id}}", function(data) {
    $.each(data, function(index, value) {
      jdays.push(value);
    });

    //My function to intialize the datepicker
    $('#calendar').datepicker({
      inline: true,
      minDate: 0,
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

console.log(dates)
$('#dates').val(dates);
  date = moment(date).format('YYYY-MM-DD');
  var gotDate = jQuery.inArray(date, dates);
  for(var i = 0; i < jdays.length; i++) {
    jDate = moment(jdays[i]).format('YYYY-MM-DD');
    if (gotDate >= 0) {
          // Enable date so it can be deselected. Set style to be highlighted
          return [true, "ui-state-selected"];
    }
    else if(jDate == date) {
      return[true, "ui-state-highlight"];
    }

  }
  return false;
}

/**
 * Gets times available for the day selected
 * Populates the daytimes id with dates available
 */
function getTimes(d)
{
   addOrRemoveDate(d);
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
</script>