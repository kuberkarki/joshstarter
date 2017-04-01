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
<img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($booking->id,'C39+',3,133) }}" alt="barcode"   /><br/>
powered by: <a href="http://eventdayplanner.com">www.eventdayplanner.com</a><br/>
<img src="http://localhost:8888/eventdayplanner/public/assets/images/eventday/eventdayPlanner.png" class="img-responsive">