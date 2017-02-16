@extends('layouts/eventday')

{{-- Page title --}}
@section('title')
Book Now
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
              @include('notifications')
                     @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <span><a href="{{url('event',$event->slug)}}" title="{{ $event->name}}"> {{ $event->name }}</a></span><br/>
                   
                    <span>{{ $event->location }}</span><BR/>
                    <span>Event Date: {{$event->date}}</span>
                    

                    {!! Form::open(['url' => 'paymentevent','files'=>true]) !!}
                        {!! Form::hidden('dates', '') !!}
                        {!! Form::hidden('event_id', $event->id) !!}

                    

                   
            
					           <div class="form-group">
                        {!! Form::label('price', 'Price: ') !!}
                        : {!! Helper::getPrice($event->ticket_price) !!} Per person
                    </div>

                    <div class="form-group">
                        {!! Form::label('quantity', 'Quantity: ') !!}
                        
                        {{ Form::selectRange('quantity', 1, 15,'',['class'=>'form-control quantity-select']) }}
                    </div>

                    <div class="form-group">
                        
                        <div class="col-sm-4">
                            
                            <button type="submit" class="btn btn-success">
                              @if($event->ticket_price>0) <i class="fa fa-paypal" aria-hidden="true"></i>ay with Paypal
                              @else
                                Book Free Ticket
                              @endif
                            </button>
                        </div>
                    </div>

                    {!! Form::close() !!}

                    <br/><br/>

                    <div class="gap"></div>

                    @if($event->ticket_price>0)
                    
                     {!! Form::open(['url' => 'payment-card','files'=>true,'class'=>'form-horizontal','role'=>'form']) !!}
                         
                            <fieldset>
                              <legend>Or Payment with Creditcard</legend>
                              <div class="form-group">
                                <label class="col-sm-3 control-label" for="card-holder-name">Name on Card</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control" name="card_holder_name" id="card-holder-name" placeholder="Card Holder's Name">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-sm-3 control-label" for="card-number">Card Number</label>
                                <div class="col-sm-9">
                                  <input type="text" class="form-control" name="card_number" id="card-number" placeholder="Debit/Credit Card Number">
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-sm-3 control-label" for="expiry-month">Expiration Date</label>
                                <div class="col-sm-9">
                                  <div class="row">
                                    <div class="col-xs-3">
                                      <select class="form-control col-sm-2" name="expiry_month" id="expiry-month">
                                        <option>Month</option>
                                        <option value="01">Jan (01)</option>
                                        <option value="02">Feb (02)</option>
                                        <option value="03">Mar (03)</option>
                                        <option value="04">Apr (04)</option>
                                        <option value="05">May (05)</option>
                                        <option value="06">June (06)</option>
                                        <option value="07">July (07)</option>
                                        <option value="08">Aug (08)</option>
                                        <option value="09">Sep (09)</option>
                                        <option value="10">Oct (10)</option>
                                        <option value="11">Nov (11)</option>
                                        <option value="12">Dec (12)</option>
                                      </select>
                                    </div>
                                    <div class="col-xs-3">
                                      <select class="form-control" name="expiry_year">
                                        
                                        <option value="16">2016</option>
                                        <option value="17">2017</option>
                                        <option value="18">2018</option>
                                        <option value="19">2019</option>
                                        <option value="20">2020</option>
                                        <option value="21">2021</option>
                                        <option value="22">2022</option>
                                        <option value="23">2023</option>
                                        <option value="23">2024</option>
                                        <option value="23">2025</option>
                                        <option value="23">2026</option>
                                      </select>
                                    </div>

                                    
                                  </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-sm-3 control-label" for="cvv">Card CVV</label>
                                <div class="col-sm-3">
                                  <input type="text" class="form-control" name="cvv" id="cvv" placeholder="Security Code">
                                </div>
                              </div>
                              <div class="form-group">
                                      <label class="col-sm-3 control-label" >Quantity</label>
                                      
                                       <div class="col-xs-3">{{ Form::selectRange('quantity', 1, 15,'',['class'=>'form-control quantity-select']) }}
                                       </div>
                                   </div>
                              <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                  <button type="submit" class="btn btn-success"><i class="fa fa-credit-card" aria-hidden="true"></i> Pay with Creditcard</button>
                                </div>
                              </div>
                            </fieldset>
                          {!! Form::close() !!}
                          @endif
                     

        </div>
    </div>
</div>
</div>

    <!-- row-->
</section>

@stop