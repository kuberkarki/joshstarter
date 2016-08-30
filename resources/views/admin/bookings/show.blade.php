@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
booking
@parent
@stop

@section('content')
<section class="content-header">
    <h1>Bookings</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>bookings</li>
        <li class="active">bookings</li>
    </ol>
</section>

<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-heading clearfix">
                <h4 class="panel-title"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    booking {{ $booking->id }}'s details
                </h4>
            </div>
            <br />
            <div class="panel-body">
                <table class="table">
                    <tr><td>id</td><td>{{ $booking->id }}</td></tr>
                     <tr><td>name</td><td>{{ $booking['name'] }}</td></tr>
					<tr><td>price</td><td>{{ $booking['price'] }}</td></tr>
					<tr><td>customer_name</td><td>{{ $booking['customer_name'] }}</td></tr>
					<tr><td>book_date</td><td>{{ $booking['book_date'] }}</td></tr>
					<tr><td>status</td><td>{{ $booking['status'] }}</td></tr>
					
                </table>
            </div>
        </div>
    </div>
</div>
@stop