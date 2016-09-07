<ul class="nav navbar-nav navbar-right">
    <li><a href="{{ URL::to('my-account-business') }}">Profile</a></li>
    <li><a href="{{ URL::to('ads') }}">Ads</a></li>
    <li><a href="#">Manage Booking</a></li>
    <li><a href="{{ URL::to('messages') }}">Messages @include('messenger.unread-count')</a></li>
    <li><a href="#">Sales Track</a></li>
    <li><a href="#">Total Revenue</a></li>
    <li><a href="#">Reviews on Ads</a></li>
    <li><a href="#">Portfolio</a></li>
</ul>