@extends('layouts.eventday')

{{-- Page title --}}
@section('title')
    Create event
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/iCheck/css/minimal/blue.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/select2/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/select2/css/select2-bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datetimepicker/css/bootstrap-datetimepicker.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/user_account.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datetimepicker.css') }}" />

@stop

{{-- Page content --}}
@section('content')
<div class="container ">
<h2>My Bookings</h2>

<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#home">Events</a></li>
  <li><a data-toggle="tab" href="#menu1">Ads</a></li>
  
</ul>

<div class="tab-content">
  <div id="home" class="tab-pane fade in active">
    <h3>Booked Event Tickets</h3>
    <ul>
    @foreach($events_booked as $event)
    	<li><div>
    			<h3><a href="{{url('event',$event->event->slug)}}">{{$event->event->name}}</a></h3>
    			<b>Quantity:</b>{{$event->quantity}}<br/>
    			<b>Price:</b>{!! Helper::getPrice($event->price) !!}
    		</div>
    	</li>
    @endforeach
    </ul>
  </div>
  <div id="menu1" class="tab-pane fade">
    <h3>Booked Ads</h3>
    @if(count($ads_booked))
	    @foreach($ads_booked as $ad)
	    	<div>
	    			<h3><a href="{{url('ads.details',$ad->ad->slug)}}">{{$ad->ad->title}}</a></h3>
	    			<b>Date:</b>{{$ad->book_date}}<br/>
	    			<b>Price:</b>{!! Helper::getPrice($ad->price) !!}
	    		</div>
	    @endforeach
	 @else
	 	No Ads Booked Yet !!
	 @endif
  </div>
  
</div>
</div>
@stop