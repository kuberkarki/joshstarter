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
        <div class="row">
          <div class="social">
            <ul>
              <a href="https://www.instagram.com/eventdayplanner/" target="_blank"><li><i class="fa fa-instagram" aria-hidden="true"></i></li></a>
              <a href="https://twitter.com/eventdayplanner" target="_blank"><li><i class="fa fa-twitter" aria-hidden="true"></i></li></a>
              <a href="https://www.facebook.com/eventdayplanner/" target="_blank"><li><i class="fa fa-facebook" aria-hidden="true"></i></li></a>
              <a href="https://uk.pinterest.com/eventdayplanner/" target="_blank"><li><i class="fa fa-pinterest" aria-hidden="true"></i></li></a>
              <a href="www.linkedin.com/in/eventdayplanner" target="_blank"><li><i class="fa fa-linkedin" aria-hidden="true"></i></li></a>
            </ul>
          </div>
        </div>
      </div>
       <footer class="footer">
            2016 <a href="#">Eventdayplanner.com</a> | 
            <a type="button" data-toggle="modal" data-target="#partnerModal">Partner</a> | 
            <a type="button" data-toggle="modal" data-target="#investorModal">Investor</a> | 
            <a type="button" data-toggle="modal" data-target="#careerModal">Career</a> | 
            <a href="#">Privacy & Policy</a>
          </footer>
    </section>
{!! form::close() !!}

    <!-- Partner Model Box  -->
<div class="modal fade" id="partnerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    {!! Form::open(['url' => route('partner'),'id'=>'partner']) !!}
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">New message</h4>
      </div>
      <div class="modal-body">
      
          <div class="form-group">
            <label for="recipient-name" class="control-label">Name:</label>
            <input type="text" class="form-control reequired" name="name" id="recipient-name" placeholder="enter name">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="control-label">Company:</label>
            <input type="text" class="form-control required" name="company" id="recipient-name" placeholder="enter company">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="control-label">Email:</label>
            <input type="text" class="form-control required" name="email" id="recipient-name" placeholder="enter email">
          </div>
          <div class="form-group">
            <label for="message-text" class="control-label">Message:</label>
            <textarea class="form-control requried" name="message" id="message-text" placeholder="enter optional message"></textarea>
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Send message</button>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
<!-- Partner Model Box  -->


<!-- Investor Model Box  -->
<div class="modal fade" id="investorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    {!! Form::open(['url' => route('investor'),'id'=>'investor']) !!}
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">New message</h4>
      </div>
      <div class="modal-body">
       
          <div class="form-group">
            <label for="recipient-name" class="control-label">Name:</label>
            <input type="text" class="form-control required" name="name" id="recipient-name" placeholder="enter name">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="control-label">Company:</label>
            <input type="text" class="form-control required" name="company" id="recipient-name" placeholder="enter company">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="control-label">Email:</label>
            <input type="text" class="form-control required" name="email" id="recipient-name" placeholder="enter email">
          </div>
          <div class="form-group">
            <label for="message-text" class="control-label">Message:</label>
            <textarea class="form-control required" name="message" id="message-text" placeholder="enter optional message"></textarea>
          </div>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" value="Send message" />
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
<!-- Investor Model Box  -->


<!-- Investor Model Box  -->
<div class="modal fade" id="careerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    {!! Form::open(['url' => route('career'),'id'=>'career']) !!}
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">New message</h4>
      </div>
      <div class="modal-body">
        
          <div class="form-group">
            <label for="recipient-name" class="control-label">Name:</label>
            <input type="text" class="form-control required" name="name" id="recipient-name" placeholder="enter name">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="control-label">Expertised:</label>
            <input type="text" class="form-control required" name="expertised" id="expertised" placeholder="enter expertised">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="control-label">Email:</label>
            <input type="text" class="form-control required" name="email" id="recipient-email" placeholder="enter email">
          </div>
          <div class="form-group">
            <label for="recipient-name" class="control-label">Location:</label>
            <input type="text" class="form-control required" name="location" id="recipient-name" placeholder="enter location">
          </div>
          <div class="form-group">
            <label for="message-text" class="control-label">Message:</label>
            <textarea class="form-control" id="message-text" name="message" placeholder="enter optional message"></textarea>
          </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" value="Send message" />
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
<!-- Investor Model Box  -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script type="text/javascript">
  $('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var recipient = button.data('whatever') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  // var modal = $(this)
  // modal.find('.modal-title').text('New message to ' + recipient)
  // modal.find('.modal-body input').val(recipient)
})
</script>
    </body>
</html>
