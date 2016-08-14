@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
event
@parent
@stop

@section('content')
<section class="content-header">
    <h1>Events</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>events</li>
        <li class="active">events</li>
    </ol>
</section>

<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-heading clearfix">
                <h4 class="panel-title"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    event {{ $event->id }}'s details
                </h4>
            </div>
            <br />
            <div class="panel-body">
                <table class="table">
                    <tr><td>id</td><td>{{ $event->id }}</td></tr>
                     <tr><td>name</td><td>{{ $event['name'] }}</td></tr>
					<tr><td>type</td><td>{{ $event['type'] }}</td></tr>
					<tr><td>location</td><td>{{ $event['location'] }}</td></tr>
					<tr><td>date</td><td>{{ $event['date'] }}</td></tr>
					<tr><td>venue</td><td>{{ $event['venue'] }}</td></tr>
					<tr><td>decorator</td><td>{{ $event['decorator'] }}</td></tr>
					<tr><td>staff</td><td>{{ $event['staff'] }}</td></tr>
					<tr><td>cake</td><td>{{ $event['cake'] }}</td></tr>
					<tr><td>sound_system</td><td>{{ $event['sound_system'] }}</td></tr>
					<tr><td>flowers</td><td>{{ $event['flowers'] }}</td></tr>
					<tr><td>bridal_dress</td><td>{{ $event['bridal_dress'] }}</td></tr>
					<tr><td>video_grapher</td><td>{{ $event['video_grapher'] }}</td></tr>
					<tr><td>photo_grapher</td><td>{{ $event['photo_grapher'] }}</td></tr>
					<tr><td>wedding_car</td><td>{{ $event['wedding_car'] }}</td></tr>
					<tr><td>description</td><td>{{ $event['description'] }}</td></tr>
					<tr><td>highlight</td><td>{{ $event['highlight'] }}</td></tr>
					<tr><td>photo</td><td><img src="{{URL::to('uploads/crudfiles/'.$event['photo'])}}" class="img-responsive" alt="Image"></td></tr>
					
                </table>
            </div>
        </div>
    </div>
</div>
@stop