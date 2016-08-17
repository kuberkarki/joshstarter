<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
   
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <link href="{{ asset('assets/css/eventday/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/eventday/style.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/eventday/font-awesome.css') }}" />
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <title>
    	@section('title')
        | Eventdayplanner
        @show
    </title>
    
    <!--page level css-->
    @yield('header_styles')
    <!--end of page level css-->
</head>

<body>
    <!-- Header Start -->
    <header>
      <div class="headerTop">
        <div class="container">
          <div class="row">
            <div class="col-sm-7"><div class="newsHighlight"><span>News!</span> Read review and book a resources for your upcomming event.</div></div>
            <div class="col-sm-5"><div class="topLogin"><a href="#"> Create an Event</a> | <a href="#">Least Your Business</a></div></div>
          </div>
        </div>
      </div>
      <div class="navWapper">
        <div class="container">
          <div class="row">
            <nav class="navbar navbar-default">
              <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                  <a class="navbar-brand" href="{{ url('/')}}"><img src="{{ asset('assets/images/eventday/eventdayPlanner.png')}}" class="img-responsive"></a><span class="slogan">Help to find everything you need about your event</span>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  <ul class="nav navbar-nav navbar-right">
                          <li><a href="{{ url('register')}}">Sign Up</a></li>
                          <li><a href="{{ url('login')}}">Login </a></li>
                          <li><a href="#">Country</a></li>
                          <li><a href="#">Currency</a></li>
                  </ul>
                </div><!-- /.navbar-collapse -->
              </div><!-- /.container-fluid -->
            </nav>
          </div>
        </div>
      </div>
    </header>
    <!-- //Header End -->
    
    <!-- slider / breadcrumbs section -->
    @yield('top')

    <!-- Content -->
    @yield('content')

    <!-- Footer Section Start -->
    <footer>
  <div class="container">
    <div class="row">
      <div class="col-sm-3">
      <h3>Our Expert Services</h3>
      <ul>
        <li><a href="#">Birthdays Party</a></li>
        <li><a href="#">Wedding Arrangement</a></li>
        <li><a href="#">Corporate Events</a></li>
        <li><a href="#">Bachelor Parties</a></li>
        <li><a href="#">Proposal Arrange</a></li>
        <li><a href="#">Social Meetings</a></li>
      </ul>
      </div>
      <div class="col-sm-3">
      <h3>Quick Links</h3>
      <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">About Us</a></li>
        <li><a href="#">Services</a></li>
        <li><a href="#">Booking Online</a></li>
        <li><a href="#">Contact Us</a></li>
      </ul>
      </div>
      <div class="col-sm-3">
      <div class="newsLetter">
        <h3>News Letter</h3>
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Enter Your Email">
            <span class="input-group-btn">
              <button class="btn btn-default" type="button">Submit</button>
            </span>
          </div><!-- /input-group -->
        </div>
      <div class="card">
        <h3>We Accept</h3>
        <img src="{{asset('assets/images/eventday/paypal.png')}}" alt=""><img src="{{asset('assets/images/eventday/visa.png')}}" alt=""><img src="{{ asset('assets/images/eventday/mastarcard.png')}}" alt=""><img src="{{ asset('assets/images/eventday/americanexpress.png')}}" alt="">
        </div>
      </div>
      <div class="col-sm-3">
      <h3>Contact us</h3>
      <ul>
        <li>Head office</li>
        <li>consectetur adipiscing elit UK.</li>
        <li>Phone: +(000) 000 0000</li>
        <li>Customer Service: +(000) 000 0000</li>
        <li>Email: <a href="mailto:info@eventdayplanner.com">info@eventdayplanner.com</a></li>
      </ul>
      </div>
    </div>
  </div>
  <div class="footerBottom">
      <div class="container">
        <div class="row">
          <ul>
            <li>&copy; {{date('Y')}} <a href="#"> Eventdayplanner</a>. All Rights Reserved. Developed By shahi010ster@gmail.com</li>
            <li><a href="#">Sitemap</a></li>
            <li><a href="#">Terms & Conditions</a></li>
            <li><a href="#">Privacy Policy</a></li>
          </ul>
        </div>
      </div>
  </div>
</footer>
<!--global js start-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="{{ asset('assets/js/eventday/bootstrap.min.js')}}"></script>
    
    <!--global js end-->
    <!-- begin page level js -->
    @yield('footer_scripts')
    <!-- end page level js -->
</body>
</html>
