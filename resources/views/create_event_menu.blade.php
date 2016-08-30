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
    <link rel="stylesheet" href="{{ asset('assets/css/frontend/login.css') }}" />

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
                    <div class="row ">
                        <div class="box">
                        <div class="box col-md-6 col-sm-6 col-xs-12"><h2><a href="#">I want to Book Event</a></h2></div>
                        <div class="box col-md-6 col-sm-6 col-xs-12"><h2><a href="{!! route('create-event') !!}">I Want to Create Event</a></h2></div>
                        </div>
                        </div>

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
