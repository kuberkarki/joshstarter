@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
event_anouncement
@parent
@stop

@section('content')
<section class="content-header">
    <h1>Event_anouncements</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>event_anouncements</li>
        <li class="active">event_anouncements</li>
    </ol>
</section>

<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-heading clearfix">
                <h4 class="panel-title"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    event_anouncement {{ $event_anouncement->id }}'s details
                </h4>
            </div>
            <br />
            <div class="panel-body">
                <table class="table">
                    <tr><td>id</td><td>{{ $event_anouncement->id }}</td></tr>
                     <tr><td>title</td><td>{{ $event_anouncement['title'] }}</td></tr>
					<tr><td>user_id</td><td>{{ $event_anouncement['user_id'] }}</td></tr>
					<tr><td>event_id</td><td>{{ $event_anouncement['event_id'] }}</td></tr>
					<tr><td>description</td><td>{{ $event_anouncement['description'] }}</td></tr>
					
                </table>
            </div>
        </div>
    </div>
</div>
@stop