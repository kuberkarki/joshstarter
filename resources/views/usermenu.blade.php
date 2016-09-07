@if(Sentinel::inRole('freelancer'))
 @include('freelancer.usermenu')
@elseif(Sentinel::inRole('event-organizer'))
 @include('event-organizer.usermenu')
@elseif(Sentinel::inRole('business'))
 @include('business.usermenu')
@else
<ul class="nav navbar-nav navbar-right">
    <li><a href="{{ URL::to('my-account') }}">Profile</a></li>
    <li><a href="{{route('my-events')}}">Events</a></li>
    <li><a href="#">Booking</a></li>
    <li><a href="{{ URL::to('messages') }}">Messages @include('messenger.unread-count')</a></li>
    <li><a href="#">Advertisement</a></li>
    <li><a href="#">Sales Report</a></li>
    <li><a href="#">Portfolio</a></li>
</ul>
@endif