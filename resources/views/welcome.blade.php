<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <title>EventDayPlanner.com</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="description" content="">
        <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}" />
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.css') }}" />
    </head>
    <body>
    {!! Form::open(['url' => route('contact'),'id'=>'frm']) !!}
    <header class="header">
      <div class="container">
        <div class="row">
        <div class="logo">
          <img src="{{ asset('assets/images/logo-eventday.png') }}" class="img-responsive">
          </div>
          <div class="introTxt">Manage your business and event from every corner. <br>
Make it affordable, memorable and profitable<br>
For more update...</div>
<div class="formHolder">
@if ($errors->any())
<div class="alert alert-danger alert-dismissable ">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <strong>Error:</strong> Please check the form below for errors
</div>
@endif

@if ($message = Session::get('success'))
<div class="alert alert-success alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong>Success:</strong> {{ $message }}
</div>
@endif

@if ($message = Session::get('error'))
<div class="alert alert-danger alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong>Error:</strong> {{ $message }}
</div>
@endif

@if ($message = Session::get('warning'))
<div class="alert alert-warning alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong>Warning:</strong> {{ $message }}
</div>
@endif

@if ($message = Session::get('info'))
<div class="alert alert-info alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <strong>Info:</strong> {{ $message }}
</div>
@endif
  <div class="input-group">
  <input type="text" class="form-control input-lg" name="contact-name" placeholder="Your Name">
</div>
<div class="input-group">
  <input type="text" class="form-control input-lg" name="contact-email" placeholder="Email Address">
</div>
</div>
<div class="checkBOx">
  <div class="checkbox">
  <label><input type="checkbox" name="subscribe[]" value="Business Owner">Business Owner</label>
</div>
<div class="checkbox">
  <label><input type="checkbox" name="subscribe[]" value="Freelancer">Freelancer</label>
</div>
<div class="checkbox">
  <label><input type="checkbox" name="subscribe[]" value="Event Organizer">Event Organizer</label>
</div>
<div class="checkbox">
  <label><input type="checkbox" name="subscribe[]" value="Visitor">Visitors</label>
</div>
</div>
        </div>
      </div>

    </header>
    <section class="joinUs">
      <div class="container"><br><br>
        <input type="submit" class="btn btn-default" value="Join Us Today" />
      </div>
    </section>
{!! form::close() !!}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    </body>
</html>
