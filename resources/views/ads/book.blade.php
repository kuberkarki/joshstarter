@extends('layouts/eventday')

{{-- Page title --}}
@section('title')
Create New booking
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
            <h1>Book Now</h1>
                     @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <span>{{ $ad->title }}</span><br/>
                    <span>{{ $ad->category()->first()->name }}</span><br/>
                    <span>{{ $ad->location }}</span>
                    <span>Booking Dates: {{$dates}}</span>
                    

                    {!! Form::open(['url' => 'ads/bookings','files'=>true]) !!}
                        {!! Form::hidden('dates', $dates) !!}
                        {!! Form::hidden('ads_id', $ad->id) !!}

                    <h2>Options</h2>

                    @if($ad->price_type!='variable')
            
					<div class="form-group">
                        {!! Form::label('price', 'Price: ') !!}
                        {!! Form::text('price', $ad->price, ['class' => 'form-control']) !!}
                    </div>
                    

                    @else
                    <ul>
                
                    @foreach($ad->prices()->get() as $price)
            
                    <li> min guest {{$price->minguest}} to max guest {{ $price->maxguest}}
                        <label>{!! Form::radio('price', $price->price, ['class' => 'form-control']) !!}
                      ${!! $price->price!!}</label>
                    </li>
                    @endforeach
                    </ul>
                    @endif


					
                       
                        {!! Form::hidden('book_dates', $dates, ['class' => 'form-control']) !!}
                    

					

					

                    <div class="form-group">
                        <div class="col-sm-4">
                            
                            <button type="submit" class="btn btn-success">
                                Book Now
                            </button>
                        </div>
                    </div>

                    {!! Form::close() !!}

        </div>
    </div>
</div>
</div>

    <!-- row-->
</section>

@stop