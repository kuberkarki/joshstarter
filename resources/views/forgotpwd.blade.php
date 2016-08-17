@extends('layouts/eventday')

{{-- Page title --}}
@section('title')
Login
@parent
@stop

{{-- page level styles --}}
@section('header_styles')    
    
    <link href="{{ asset('assets/css/pages/alertmessage.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/pages/mail_box.css') }}" rel="stylesheet" type="text/css" />
    <link type="text/css" rel="stylesheet" href="{{asset('assets/vendors/iCheck/css/all.css')}}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/login.css') }}">
    <!-- page level css ends-->
@stop

{{-- Page content --}}
@section('content')
<section class="bannerWrapper innerBanner">
  <div class="searchWrap">
    <div class="container">
        <h1>Forgot Password</h1>
           
    </div>
  </div>
</section>
<div class="container textsmall">
    <div class="row">
        <div class="box animation flipInX">
            <div class="box1">
            
            <p>Enter your email to send the password</p>
            @include('notifications')
            <form action="{{ route('forgot-password') }}" class="omb_loginForm" autocomplete="off" method="POST">
                {!! Form::token() !!}
                <div class="form-group">
                    <label class="sr-only"></label>
                    <input type="email" class="form-control email" name="email" placeholder="Email"
                           value="{!! old('email') !!}">
                    <span class="help-block">{{ $errors->first('email', ':message') }}</span>
                </div>
                <div class="form-group">
                    <input class="form-control btn btn-default btn-block" type="submit" value="Reset Your Password">
                </div>
            </form>
        </div>
        </div>
    </div>
</div>
@stop

@section('footer_script')
<!--global js starts-->
<script type="text/javascript" src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<!--global js end-->
@stop
