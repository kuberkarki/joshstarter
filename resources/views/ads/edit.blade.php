
@extends('layouts.eventday')

{{-- Page title --}}
@section('title')
    Edit Ads
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/jasny-bootstrap/css/jasny-bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/iCheck/css/minimal/blue.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/select2/css/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/select2/css/select2-bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datetimepicker/css/bootstrap-datetimepicker.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/user_account.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap-datetimepicker.css') }}" />

@stop

{{-- Page content --}}
@section('content')
<section class="bannerWrapper innerBanner">
  <div class="searchWrap">
    <div class="container">
        <h1>Edit Ads</h1>
           
    </div>
  </div>
</section>
<div class="container textsmall">
    <div class="row">
            <div class="row">
                <div class="col-md-6">
                    <!--main content-->
                    <div class="position-center">
                        <!-- Notifications -->
                        @include('notifications')<div class="panel-body">
                     @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    {!! Form::model($ad, ['method' => 'PATCH', 'action' => ['AdsController@editads', $ad->id],'files'=>true]) !!}

                     <div class="form-group">
                            {!! Form::label('ads_category_id', 'Category') !!}
                            {!! Form::select('ads_category_id',$ads_category ,null, array('class' => 'form-control select2', 'placeholder'=>'Select Category')) !!}
                        </div>

                    <div class="form-group">
                        {!! Form::label('title', 'Title: ') !!}
                        {!! Form::text('title', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('location', 'Location: ') !!}
                        
                         <input id="geocomplete" value="{!! old('location',$ad->location) !!}" type="text" placeholder="Type in an address" class='form-control' name="location" />
                    </div>

					<div class="form-group">
                        {!! Form::label('description', 'Description: ') !!}
                        {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('photo', 'Photo: ') !!}

                        <div class="col-md-12">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="max-width: 200px; max-height: 150px;">
                                            @if(isset($ad->photo))
                                                <img src="{{ URL::to('/uploads/crudfiles/'.$ad->photo)  }}" alt="..."
                                                     class="img-responsive"/>
                                            @else
                                            <img src="http://placehold.it/200x150" alt="..."
                                                     class="img-responsive"/>
                                            @endif

                                           
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                                        <div>
                                                            <span class="btn btn-primary btn-file">
                                                                <span class="fileinput-new">Select image</span>
                                                                <span class="fileinput-exists">Change</span>
                                                                <input value="{!! old('photo',$ad->photo) !!}" type="file" name="photo_image" id="pic" />
                                                            </span>
                                            <span class="btn btn-primary fileinput-exists" data-dismiss="fileinput">Remove</span>
                                        </div>
                                    </div>
                                </div>
                    </div>

					<div class="form-group">
                        {!! Form::label('video', 'Video: ') !!}
                        {!! Form::text('video', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('available_date', 'Available Date: ') !!}
                        {!! Form::text('available_date', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('price', 'Price: ') !!}
                        {!! Form::text('price', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('additional_package_offer', 'Additional Package Offer: ') !!}
                        {!! Form::textarea('additional_package_offer', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('additional_ads_title', 'Additional Ads Title: ') !!}
                        {!! Form::text('additional_ads_title', null, ['class' => 'form-control']) !!}
                    </div>

					<div class="form-group">
                        {!! Form::label('price_type', 'Price Type: ') !!}
                        {!! Form::text('price_type', null, ['class' => 'form-control']) !!}
                    </div>

					

					

                    <div class="form-group">
                        {!! Form::submit('Update', ['class' => 'btn btn-default form-control']) !!}
                    </div>
                    {!! Form::close() !!}

               
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
{{-- page level scripts --}}
@section('footer_scripts')

    <script type="text/javascript" src="{{ asset('assets/vendors/moment/js/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/iCheck/js/icheck.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/select2/js/select2.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/bootstrap-datetimepicker.js') }}"></script>
  <!-- include your less or built css files  -->
  <!-- 
  bootstrap-datetimepicker-build.less will pull in "../bootstrap/variables.less" and "bootstrap-datetimepicker.less";
  or
  <link rel="stylesheet" href="/Content/bootstrap-datetimepicker.css" />-->
    <!-- <script type="text/javascript" src="{{ asset('assets/vendors/datetimepicker/js/bootstrap-datetimepicker.js') }}"></script> -->
    <!-- <script type="text/javascript" src="{{ asset('assets/js/frontend/user_account.js') }}"></script> -->
    
     <script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places&key=AIzaSyDrUptjcGVTBOTkmq61SHWodlr1FZCPyY8"></script>
     <script src="{{ asset('assets/js/jquery.geocomplete.js') }}"></script>
     <script>
      $(function(){
        
        $("#geocomplete").geocomplete()
          /*.bind("geocode:result", function(event, result){
            $.log("Result: " + result.formatted_address);
          })
          .bind("geocode:error", function(event, status){
            $.log("ERROR: " + status);
          })*/
          /*.bind("geocode:multiple", function(event, results){
            $.log("Multiple: " + results.length + " results found");
          });*/
        
        /*$("#find").click(function(){
          $("#geocomplete").trigger("geocode");
        });*/
        
        
        
        
      });

      $('#datetimepicker1').datetimepicker({
           // dateFormat: 'dd-mm-yy',
           format:'YYYY-MM-DD HH:mm:ss'
           // minDate: getFormattedDate(new Date())
        });
    </script>
@stop
