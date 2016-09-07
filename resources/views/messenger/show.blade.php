@extends('layouts.eventday')

@section('content')
      @include('usermenu')

<section class="mainContainer">
<div class="contantWrapper innercontantWrapper adsListing">
  <div class="container">
      <div class="row">
      <div class="col-sm-12"><h3>{{ $thread->subject }}</h3></div>
      <div class="col-sm-9">
        
      </div>
     
      </div>
    <div class="col-md-6">
       

        @foreach($thread->messages as $message)
            <div class="media">
                <a class="pull-left" href="#">
                    <img src="//www.gravatar.com/avatar/{{ md5($message->user->email) }} ?s=64" alt="{{ $message->user->name }}" class="img-circle">
                </a>
                <div class="media-body">
                    <h5 class="media-heading">{{ $message->user->first_name }} {{ $message->user->last_name }}</h5>
                    <p>{!! $message->body !!}</p>
                    <div class="text-muted"><small>Posted {{ $message->created_at->diffForHumans() }}</small></div>
                </div>
            </div>
        @endforeach

        <h2>Reply message</h2>
        {!! Form::open(['route' => ['messages.update', $thread->id], 'method' => 'PUT']) !!}
        <!-- Message Form Input -->
        <div class="form-group">
            {!! Form::textarea('message', null, ['class' => 'form-control']) !!}
        </div>

        

        <!-- Submit Form Input -->
        <div class="form-group">
            {!! Form::submit('Submit', ['class' => 'btn btn-primary form-control']) !!}
        </div>
        {!! Form::close() !!}
    </div>
    </div>
    </div>
    </section>
@stop
