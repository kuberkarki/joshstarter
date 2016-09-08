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
                    

                    {!! Form::open(['url' => 'ads/bookings','files'=>true]) !!}

                    <div class="form-group">
                        {!! Form::label('name', 'Name: ') !!}
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                    </div>

                    @if($ad->price_type=='fixed')
            
					<div class="form-group">
                        {!! Form::label('price', 'Price: ') !!}
                        {!! Form::text('price', $ad->price, ['class' => 'form-control']) !!}
                    </div>
                    

                    @else

                    @foreach($ad->prices()->get() as $price)
            
                    <div class="form-group"> min guest {{$price->minguest}} to max guest {{ $price->maxguest}}
                        <label>{!! Form::radio('price', $price->price, ['class' => 'form-control']) !!}
                      ${!! $price->price!!}</label>
                    </div>
                    @endforeach
                    @endif

					<div class="form-group">
                        {!! Form::label('customer_name', 'Customer Name: ') !!}
                        {!! Form::text('customer_name', Sentinel::getUser()->first_name, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('book_date', 'Book Date: ') !!}
                        {!! Form::text('book_date', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('status', 'Status: ') !!}
                        {!! Form::text('status', null, ['class' => 'form-control']) !!}
                    </div>

					

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