@extends('layouts/eventday')

{{-- Page title --}}
@section('title')
Book Now
@parent
@stop

{{-- Page content --}}
@section('content')


<!-- Main content -->
<section class="mainContainer">
<div class="contantWrapper innercontantWrapper adsPage">
  <div class="container globalWrap">
      <div class="row">
        <div class="col-sm-6">
            <h1>Your Ticket</h1>
              @include('notifications')
                     @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    
						<h2>{{$event->name}}</h2><br/>
						Date: {{$event->date}}<br/>
						Organized By: 

						@if($organizer->company_name){{ $organizer->company_name}}
						@elseif($organizer->first_name)
						{{$organizer->first_name.' '.$organizer->last_name}}
						@endif
						<br/>
						Total no. {{$booking->quantity}}
						<br/>
						@if($event->ticket_price>0)
						Amount: {{$booking->amount}}
						@else
						<b>Free Pass</b>
						@endif
						<br/>
						<img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($booking->id,'C39+',3,133) }}" alt="barcode"   />
						<br/>
						<span><a href="{{url('event',$event->slug)}}" title="{{ $event->name}}"> More Details on "{{ $event->name }}"</a></span>&nbsp;|&nbsp;<span><a href="{{ url('events/downloadticket',$booking->id)}}">Download PDF</a></span>
						</div>
						</div>
						</div>
						</div>
						</section>
						@stop
