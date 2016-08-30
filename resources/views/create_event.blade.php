@extends('layouts.eventday')

{{-- Page title --}}
@section('title')
    Create event
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
        <h1>Create Event</h1>
           
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
                        @include('notifications')

                        
                        <div class="panel-body">
                     @if ($errors->any())
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif

                    {!! Form::open(['url' => 'events','files'=>true]) !!}

                    <div class="form-group">
                        {!! Form::label('name', 'Event Name: ') !!}
                        {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('type', 'Type: ') !!}
                        

                        {!! Form::select('type', array(
                            'personal' => 'Personal','private' => 'private','public' => 'Public','charity' => 'Charity')
                        ,old('type'), ['class' => 'form-control']) !!}
                    </div>
                        
                    
                   <div class="form-group">
                   {!! Form::label('location', 'Location: ') !!}
                   <input id="geocomplete" value="{!! old('location') !!}" type="text" placeholder="Type in an address" class='form-control' name="location" />
                   <!--  <input id="find" type="button" value="find" /> -->
                       <!--   {!! Form::label('location', 'Event Location: ') !!}
                        {!! Form::text('location', null, ['class' => 'form-control','id'=>'location']) !!}-->
                    </div> 

                    <div class="form-group">
                        {!! Form::label('date', 'Date: ') !!}
                        <div class='input-group date' >
                            <input type='text' value="{!! old('date') !!}" name="date" class="form-control" id='datetimepicker1' />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>

                    

                    <div class="form-group">
                    {!! Form::label('photo', 'Banner or Photo:') !!}
                                
                                <div class="col-md-12">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="max-width: 200px; max-height: 150px;">
                                            
                                                <img src="http://placehold.it/200x150" alt="..."
                                                     class="img-responsive"/>
                                           
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
                                        <div>
                                                            <span class="btn btn-primary btn-file">
                                                                <span class="fileinput-new">Select image</span>
                                                                <span class="fileinput-exists">Change</span>
                                                                <input value="{!! old('photo_image') !!}" type="file" name="photo_image" id="pic" />
                                                            </span>
                                            <span class="btn btn-primary fileinput-exists" data-dismiss="fileinput">Remove</span>
                                        </div>
                                    </div>
                                </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('video', 'Video Link: ') !!}
                        {!! Form::text('video_link', old('video_link'), ['class' => 'form-control']) !!}
                        <span><i>Vimeo or Youtube</i></span>
                    </div>

                    <div class="form-group">
                        {!! Form::label('description', 'Description: ') !!}
                        {!! Form::textarea('description', old('description'), ['class' => 'form-control']) !!}
                       
                    </div>

                    <div class="form-group">
                        {!! Form::label('sponsors', 'Sponsors: ') !!}
                        {!! Form::text('sponsor', old('sponsor'), ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('ticket_price', 'Ticket Price: ') !!}
                        {!! Form::text('ticket_price', old('ticket_price'), ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('contact_price', 'Contact Person: ') !!}
                        {!! Form::textarea('contact_person', old('contact_person'), ['class' => 'form-control']) !!}
                       
                    </div>

                    <div class="form-group">
                        {!! Form::label('landline', 'Landline: ') !!}
                        {!! Form::text('land_line', old('land_line'), ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('mobile', 'Mobile: ') !!}
                        {!! Form::text('mobile', old('mobile'), ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('contact_person_address', 'Contact Person Address: ') !!}
                        {!! Form::text('contact_person_address', old('conatct_person_address'), ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                    {!! Form::label('verify', 'Verify: ') !!}

                    {!! captcha_img('captcha') !!} <br/>
                     <input type="text" name="captcha" class="form-control">
                     </div>

                    

                    

                    

                    <div class="form-group">
                        <div class=" col-sm-4">
                            <!-- <a class="btn btn-danger" href="{{ route('admin.events.index') }}">
                                @lang('button.cancel')
                            </a> -->
                            <button type="submit" class="btn btn-success">
                                @lang('button.save')
                            </button>
                        </div>
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
