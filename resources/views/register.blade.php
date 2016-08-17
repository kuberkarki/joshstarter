@extends('layouts/eventday')

{{-- Page title --}}
@section('title')
Register
@parent
@stop

{{-- page level styles --}}
@section('header_styles')    
    
    <link href="{{ asset('assets/css/pages/alertmessage.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/pages/mail_box.css') }}" rel="stylesheet" type="text/css" />
    <link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/iCheck/css/all.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/register.css') }}">
    <!-- page level css ends-->
@stop

{{-- Page content --}}
@section('content')
<section class="bannerWrapper innerBanner">
  <div class="searchWrap">
    <div class="container">
        <h1>Register Now !!</h1>
           
    </div>
  </div>
</section>
<div class="container textsmall">
    <!--Content Section Start -->
    <div class="row">
        <div class="box animation flipInX">
            
            <!-- Notifications -->
            @include('notifications')
            @if($errors->has())
                @foreach ($errors->all() as $error)
                    <div class="text-danger">{{ $error }}</div>
                @endforeach
            @endif
            <form action="{{ route('register') }}" method="POST">
                <!-- CSRF Token -->
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                <div class="form-group {{ $errors->first('first_name', 'has-error') }}">
                    <label class="sr-only"> First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name"
                           value="{!! old('first_name') !!}" required>
                    {!! $errors->first('first_name', '<span class="help-block">:message</span>') !!}
                </div>
                <div class="form-group {{ $errors->first('last_name', 'has-error') }}">
                    <label class="sr-only"> Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name"
                           value="{!! old('last_name') !!}" required>
                    {!! $errors->first('last_name', '<span class="help-block">:message</span>') !!}
                </div>
                <div class="form-group {{ $errors->first('email', 'has-error') }}">
                    <label class="sr-only"> Email</label>
                    <input type="email" class="form-control" id="Email" name="email" placeholder="Email"
                           value="{!! old('Email') !!}" required>
                    {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                </div>
                <div class="form-group {{ $errors->first('password', 'has-error') }}">
                    <label class="sr-only"> Password</label>
                    <input type="password" class="form-control" id="Password1" name="password" placeholder="Password">
                    {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                </div>
                <div class="form-group {{ $errors->first('password_confirm', 'has-error') }}">
                    <label class="sr-only"> Confirm Password</label>
                    <input type="password" class="form-control" id="Password2" name="password_confirm"
                           placeholder="Confirm Password">
                    {!! $errors->first('password_confirm', '<span class="help-block">:message</span>') !!}
                </div>
                <div class="form-group {{ $errors->first('gender', 'has-error') }}">
                    <label class="sr-only">Gender</label>
                    <label class="radio-inline">
                        <input type="radio" name="gender" id="inlineRadio1" value="male"> Male
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="gender" id="inlineRadio2" value="female"> Female
                    </label>
                    {!! $errors->first('gender', '<span class="help-block">:message</span>') !!}
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" checked name="subscribed" >  I accept <a href="#"> Terms and Conditions</a>
                    </label>
                </div>
                <input type="submit" class="btn btn-block btn-default" value="Sign up" name="submit">
                Already have an account? Please <a href="{{ route('login') }}"> Sign In</a>
            </form>
        </div>
    </div>
    <!-- //Content Section End -->
</div>
@stop
@section('footer_script')
<!--global js starts-->
<script type="text/javascript" src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/vendors/iCheck/js/icheck.js') }}"></script>
<!--global js end-->
<script>
    $(document).ready(function(){
        $("input[type='checkbox'],input[type='radio']").iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        });
    });
</script>
@stop