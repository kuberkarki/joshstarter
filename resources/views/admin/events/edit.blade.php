@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Edit a event
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
        <li class="active">Create New event</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary ">
                <div class="panel-heading">
                    <h4 class="panel-title"> <i class="livicon" data-name="edit" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                        Edit event
                    </h4>
                </div>
                <div class="panel-body">
                     @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    {!! Form::model($event, ['method' => 'PATCH', 'action' => ['EventsController@update', $event->id],'files'=>true]) !!}

                    <div class="form-group">
                        {!! Form::label('name', 'Name: ') !!}
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('type', 'Type: ') !!}
                        {!! Form::text('type', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('location', 'Location: ') !!}
                        {!! Form::text('location', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('date', 'Date: ') !!}
                        {!! Form::text('date', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                    {!! Form::label('type', 'Requirements: ') !!} <br/>

					<div class="form-group">
                    {!! Form::label('type', 'Requirements: ') !!} 

                        <div class="form-group">

                        
                        {!!Form::label('venue')!!}
                        {!! Form::radio('venue', '1', ['class' => 'form-control'],array('id'=>'venue')) !!}

                        {!!Form::label('no_venue')!!}

                        {!! Form::radio('venue', '0', ['class' => 'form-control'],array('id'=>'no_venue')) !!}
                        </div>

                        <div class="form-group">
                        
                       {!!Form::label('decorator')!!}
                        {!! Form::radio('decorator', '1', ['class' => 'form-control'],array('id'=>'decorator')) !!}

                        {!!Form::label('No_decorator')!!}

                        {!! Form::radio('decorator', '0', ['class' => 'form-control'],array('id'=>'No_decorator')) !!}
                        </div>

                        <div class="form-group">
                        {!!Form::label('staff')!!}
                        {!! Form::radio('staff', '1', ['class' => 'form-control'],array('id'=>'staff')) !!}

                        {!!Form::label('No_staff')!!}

                        {!! Form::radio('staff', '0', ['class' => 'form-control'],array('id'=>'No_staff')) !!}
                        </div>
                        <div class="form-group">
                        
                       {!!Form::label('cake')!!}
                        {!! Form::radio('cake', '1', ['class' => 'form-control'],array('id'=>'cake')) !!}

                        {!!Form::label('No_cake')!!}

                        {!! Form::radio('cake', '0', ['class' => 'form-control'],array('id'=>'No_cake')) !!}
                        </div>
                        <div class="form-group">
                        
                        {!!Form::label('sound_system')!!}
                        {!! Form::radio('sound_system', '1', ['class' => 'form-control'],array('id'=>'sound_system')) !!}

                        {!!Form::label('No_sound_system')!!}

                        {!! Form::radio('sound_system', '0', ['class' => 'form-control'],array('id'=>'No_sound_system')) !!}
                        </div>
                        <div class="form-group">
                        
                        {!!Form::label('flowers')!!}
                        {!! Form::radio('flowers', '1', ['class' => 'form-control'],array('id'=>'flowers')) !!}

                        {!!Form::label('No_flowers')!!}

                        {!! Form::radio('flowers', '0', ['class' => 'form-control'],array('id'=>'No_flowers')) !!}
                        </div>
                        <div class="form-group">
                        
                        {!!Form::label('bridal_dress')!!}
                        {!! Form::radio('bridal_dress', '1', ['class' => 'form-control'],array('id'=>'bridal_dress')) !!}

                        {!!Form::label('No_bridal_dress')!!}

                        {!! Form::radio('bridal_dress', '0', ['class' => 'form-control'],array('id'=>'No_bridal_dress')) !!}
                        </div>
                        <div class="form-group">
                        
                        {!!Form::label('video_grapher')!!}
                        {!! Form::radio('video_grapher', '1', ['class' => 'form-control'],array('id'=>'video_grapher')) !!}

                        {!!Form::label('No_video_grapher')!!}

                        {!! Form::radio('video_grapher', '0', ['class' => 'form-control'],array('id'=>'No_video_grapher')) !!}
                        </div>
                        <div class="form-group">
                        
                        {!!Form::label('photo_grapher')!!}
                        {!! Form::radio('photo_grapher', '1', ['class' => 'form-control'],array('id'=>'photo_grapher')) !!}

                        {!!Form::label('No_photo_grapher')!!}

                        {!! Form::radio('photo_grapher', '0', ['class' => 'form-control'],array('id'=>'No_photo_grapher')) !!}
                        </div>
                        <div class="form-group">
                        {!!Form::label('wedding_car')!!}
                       
                        {!! Form::radio('wedding_car', '1', ['class' => 'form-control'],array('id'=>'wedding_car')) !!}

                        {!!Form::label('No_wedding_car')!!}

                        {!! Form::radio('wedding_car', '0', ['class' => 'form-control'],array('id'=>'No_wedding_car')) !!}
                        </div>
                    </div>
                    </div>

					<div class="form-group">
                        {!! Form::label('description', 'Description: ') !!}
                        {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('highlight', 'Highlight: ') !!}
                        {!! Form::textarea('highlight', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('photo', 'Photo: ') !!}
                        &nbsp; {!! Form::file('photo_image', ['class' => 'form-control']) !!}

                    </div>

					

                    <div class="form-group">
                        {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
                    </div>
                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</section>
@stop