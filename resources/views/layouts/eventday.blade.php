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
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/eventday/mycss.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/eventday/font-awesome.css') }}" />
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
            <div class="col-sm-7"><div class="newsHighlight"><span>News!</span> {{$frontarray['onenews']->title}}</div></div>
            <div class="col-sm-5"><div class="topLogin"><a href="#" data-toggle="modal" data-target="#creatEventPageModel"> Create an Event</a> | <a href="{{url('ads')}}">List Your Business</a></div></div>

          <div id="creatEventPageModel" class="modal fade">
              <div class="modal-dialog" role="document">
                  <div class="modal-content modal-contentCreate">
                      
                      <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">x</button>
                      <h3>Create an Event</h3>
                    </div>
                      <div class="modal-body">                      
                              <div class="row createEventPage">
                                <ul>
                                  <li><a href="#">I want to Book Event</a></li>
                                  <li><a href="{!! route('create-event') !!}">I Want to Create Event</a></li>
                                </ul>
                              </div>
                          
                      </div>
                  </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
          </div>



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
                        @if(Sentinel::guest())
                          <li><a href="#" data-toggle="modal" data-target="#ModalSignupMenuForm">Sign Up</a></li>
                          <li><a href="#" data-toggle="modal" data-target="#ModalLoginForm">Login </a></li>
                       @else
                            <li {{ (Request::is('my-account') ? 'class=active' : '') }}><a href="{{ URL::to('my-account') }}">My Account</a>
                            </li>
                            <li><a href="{{ URL::to('logout') }}">Logout</a>
                            </li>
                        @endif
                       
                        @foreach($frontarray['mainmenu'] as $menu)
                        <li><a href="{{ route('page',$menu->slug)}}">{{$menu->name}}</a></li>

                        @endforeach
                        <li><div class="dropdown">
                              <a onclick="myFunction()" class="dropbtn">Currency</a>
                              <div id="myDropdown" class="dropdown-content">
                                <a {{ (session('currency')=='USD' || session('currency')=='')?'class="selected"':"" }} href="{{ URL::to('currency','USD') }}">USD</a>
                                <a {{ (session('currency')=='EUR')?'class="selected"':"" }} href="{{ URL::to('currency','EUR') }}">EUR</a>
                                <a {{ (session('currency')=='GBP')?'class="selected"':"" }} href="{{ URL::to('currency','GBP') }}">GBP</a>
                              </div>
                            </div></li>
                          
                         
                  </ul>
                </div><!-- /.navbar-collapse -->
              </div><!-- /.container-fluid -->
            </nav>
          </div>
        </div>
      </div>
    </header>
    <!-- //Header End -->
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
          @foreach($frontarray['OurExpertServices'] as $menu)
            <li><a href="{{ route('page',$menu->slug)}}">{{$menu->name}}</a></li>
          @endforeach
        <!-- <li><a href="#">Birthdays Party</a></li>
        <li><a href="#">Wedding Arrangement</a></li>
        <li><a href="#">Corporate Events</a></li>
        <li><a href="#">Bachelor Parties</a></li>
        <li><a href="#">Proposal Arrange</a></li>
        <li><a href="#">Social Meetings</a></li> -->
      </ul>
      </div>
      <div class="col-sm-3">
      <h3>Quick Links</h3>
      <ul>

        @foreach($frontarray['quicklinks'] as $link)
        <li><a href="{{ route('page',$link->slug)}}">{{$link->name}}</a></li>
        @endforeach
       
      </ul>
      </div>
      <div class="col-sm-3">
      <div class="newsLetter">
      {!! Form::open(['url' => route('contact'),'id'=>'frm']) !!}
        <h3>News Letter</h3>
        <div class="input-group">
            <input name="contact-email" type="text" class="form-control" placeholder="Enter Your Email">
            <span class="input-group-btn">
              <button class="btn btn-default" type="submit">Submit</button>
            </span>
          </div><!-- /input-group -->
        {!! Form::close() !!}
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

 <!-- Modal HTML Markup -->
<div id="ModalLoginForm" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">x</button>
            <h3>Login</h3>
          </div>
            <div class="modal-body">
                <form role="form" method="POST" action="{{ route('login') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group {{ $errors->first('email', 'has-error') }}">
                        <label class="sr-only">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Email"
                               value="{!! old('email') !!}">
                    </div>
                    <span class="help-block">{{ $errors->first('email', ':message') }}</span>
                    <div class="form-group {{ $errors->first('password', 'has-error') }}">
                        <label class="sr-only">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                    <span class="help-block">{{ $errors->first('password', ':message') }}</span>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox">  Remember Password
                        </label>

                    </div>
                    <input type="submit" class="btn btn-block btn-default" value="Login">
                   
                </form>
            </div>
            <div class="modal-footer">
            
                    Don't have an account? <a href="#" class="signup" data-toggle="modal" data-target="#ModalSignupMenuForm"><strong> Sign up</strong></a>
          </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<div id="ModalSignupMenuForm" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">x</button>
            <h3>Signup</h3>
          </div>
            <div class="modal-body">
            @include('register_menu')
            <div class="social">
            <ul>
                <li><a href="{{ route('auth.getSocialAuth','google') }}">Register with Google</a></li>
                <li><a href="{{ route('auth.getSocialAuth','facebook') }}">Register with Facebook</a></li>
                <li><a href="{{ route('auth.getSocialAuth','twitter') }}">Register with Twitter</a></li>
                <li><a href="{{ route('auth.getSocialAuth','linkedin') }}">Register with Linkedin</a></li>
            </ul>
        </div>
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

                <div class="form-group">
                    {!! captcha_img('captcha') !!} <br/>
                     <input placeholder="Please Verify" type="text" name="captcha" class="form-control">
                </div>
                <!-- <div class="form-group {{ $errors->first('gender', 'has-error') }}">
                    <label class="sr-only">Gender</label>
                    <label class="radio-inline">
                        <input type="radio" name="gender" id="inlineRadio1" value="male"> Male
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="gender" id="inlineRadio2" value="female"> Female
                    </label>
                    {!! $errors->first('gender', '<span class="help-block">:message</span>') !!}
                </div> -->
                <div class="checkbox">
                    <label>
                        <input type="checkbox" checked name="subscribed" >  I accept <a href="#"> Terms and Conditions</a>
                    </label>
                </div>
                <input type="submit" class="btn btn-block btn-default" value="Sign up" name="submit">
                Already have an account? Please <a href="{{ route('login') }}"> Sign In</a>
            </form>
                
            </div>
            <div class="modal-footer">
            
                    Already have an account? Please <a href="#" class="login" data-toggle="modal" data-target="#ModalLoginForm"> Sign In</a>
          </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div id="ModalSignupFreelancerForm" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">x</button>
            <h3>Freelancer Signup</h3>
          </div>
            <div class="modal-body">
            <div class="social">
            <ul>
                <li><a href="{{ route('freelancerauth.getSocialAuth','google') }}">Register with Google</a></li>
                <li><a href="{{ route('freelancerauth.getSocialAuth','facebook') }}">Register with Facebook</a></li>
                <li><a href="{{ route('freelancerauth.getSocialAuth','twitter') }}">Register with Twitter</a></li>
                <li><a href="{{ route('freelancerauth.getSocialAuth','linkedin') }}">Register with Linkedin</a></li>
            </ul>
        </div>
            <form action="{{ route('register-freelancer') }}" method="POST">
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
                <div class="form-group {{ $errors->first('address', 'has-error') }}">
                    <label class="sr-only">Address</label>
                    <input placeholder="Address" type="text" class="form-control" id="add1" name="address" value="{!! old('address') !!}"/> 
                    {!! $errors->first('address', '<span class="help-block">:message</span>') !!}                           
                </div>
                 <div class="form-group {{ $errors->first('country', 'has-error') }}">
                    <label class="sr-only">Select Country: </label>
                   
                        {!! Form::select('country', $countries, old('country'),['class' => 'form-control select2', 'id' => 'countries']) !!}
                       {{ $errors->first('country', ':message') }}
                </div>

                <div class="form-group {{ $errors->first('state', 'has-error') }}">
                    <label class="sr-only" for="state">State:</label>
                    
                            <input type="text" placeholder="State" id="state" class="form-control" name="state"
                                   value="{!! old('state') !!}"/>
                       
                    <span class="help-block">{{ $errors->first('state', ':message') }}</span>
                </div>

                <div class="form-group {{ $errors->first('city', 'has-error') }}">
                    <label class="sr-only" for="city">City:</label>
                    
                            <input type="text" placeholder="City" id="city" class="form-control" name="city"
                                   value="{!! old('city') !!}"/>
                       
                    <span class="help-block">{{ $errors->first('city', ':message') }}</span>
                </div>

                <div class="form-group {{ $errors->first('postal', 'has-error') }}">
                    <label class="sr-only" for="postal">Postal/Zip:</label>
                    
                            <input type="text" placeholder="Postal/Zip" id="postal" class="form-control"
                                   name="postal" value="{!! old('postal') !!}"/>
                        
                        <span class="help-block">{{ $errors->first('postal', ':message') }}</span>
                   
                </div>

                <div class="form-group {{ $errors->first('duration', 'has-error') }}">
                    <label class="sr-only" for="duration">Duration:</label>
                    
                            <input type="text" placeholder="Duration" id="duration" class="form-control"
                                   name="duration" value="{!! old('duration') !!}"/>
                        
                        <span class="help-block">{{ $errors->first('duration', ':message') }}</span>
                   
                </div>

                <div class="form-group {{ $errors->first('office_number', 'has-error') }}">
                    <label class="sr-only" for="office_number">Landline:</label>
                    <input type="text" placeholder="Landline" id="office_number" class="form-control"
                                   name="office_number" value="{!! old('office_number') !!}"/>
                        
                        <span class="help-block">{{ $errors->first('office_number', ':message') }}</span>
                    
                </div>

                <div class="form-group {{ $errors->first('mobile_number', 'has-error') }}">
                    <label class="sr-only" for="postal">Mobile Number:</label>
                    
                    <input type="text" placeholder="Mobile Number" id="mobile_number" class="form-control"
                                   name="mobile_number" value="{!! old('mobile_number') !!}"/>
                        
                        <span class="help-block">{{ $errors->first('mobile_number', ':message') }}</span>
                    
                </div>

                <div class="form-group {{ $errors->first('bio', 'has-error') }}">
                    <label class="sr-only" for="bio">Short Description:</label>
                    
                            <textarea rows="5" cols="30"  placeholder="Short Description" id="bio" class="form-control"
                                   name="bio" >{!! old('bio') !!}</textarea>
                       
                        <span class="help-block">{{ $errors->first('bio', ':message') }}</span>
                   
                </div>

                <div class="form-group">
                    {!! captcha_img('captcha') !!} <br/>
                     <input placeholder="Please Verify" type="text" name="captcha" class="form-control">
                </div>
                <!-- <div class="form-group {{ $errors->first('gender', 'has-error') }}">
                    <label class="sr-only">Gender</label>
                    <label class="radio-inline">
                        <input type="radio" name="gender" id="inlineRadio1" value="male"> Male
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="gender" id="inlineRadio2" value="female"> Female
                    </label>
                    {!! $errors->first('gender', '<span class="help-block">:message</span>') !!}
                </div> -->
                <div class="checkbox">
                    <label>
                        <input type="checkbox" checked name="subscribed" >  I accept <a href="#"> Terms and Conditions</a>
                    </label>
                </div>
                <input type="submit" class="btn btn-block btn-default" value="Sign up" name="submit">
                Already have an account? Please <a href="{{ route('login') }}"> Sign In</a>
            </form>
                
            </div>
            <div class="modal-footer">
            
                    Already have an account? Please <a href="#" class="login" data-toggle="modal" data-target="#ModalLoginForm"> Sign In</a>
          </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div id="ModalSignupBusinessForm" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">x</button>
            <h3>Business Signup</h3>
          </div>
            <div class="social">
            <ul>
                <li><a href="{{ route('businessauth.getSocialAuth','google') }}">Register with Google</a></li>
                <li><a href="{{ route('businessauth.getSocialAuth','facebook') }}">Register with Facebook</a></li>
                <li><a href="{{ route('businessauth.getSocialAuth','twitter') }}">Register with Twitter</a></li>
                <li><a href="{{ route('businessauth.getSocialAuth','linkedin') }}">Register with Linkedin</a></li>
            </ul>
            </div>
            <form action="{{ route('register-business') }}" method="POST" class="modal-contentBusinessForm">
                <!-- CSRF Token -->
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                
                <div class="form-group {{ $errors->first('first_name', 'has-error') }}">
                    <label class="sr-only"> Company Name</label>
                    <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Company Name"
                           value="{!! old('company_name') !!}" required>
                    {!! $errors->first('company_name', '<span class="help-block">:message</span>') !!}
                </div>
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
                <div class="form-group {{ $errors->first('address', 'has-error') }}">
                    <label class="sr-only">Office Location</label>
                    <input placeholder="Office Location" type="text" class="form-control" id="add1" name="address" value="{!! old('address') !!}"/> 
                    {!! $errors->first('address', '<span class="help-block">:message</span>') !!}                           
                </div>
                 <div class="form-group {{ $errors->first('country', 'has-error') }}">
                    <label class="sr-only">Select Country: </label>
                   
                        {!! Form::select('country', $countries, old('country'),['class' => 'form-control select2', 'id' => 'countries']) !!}
                       {{ $errors->first('country', ':message') }}
                </div>

                <div class="form-group {{ $errors->first('state', 'has-error') }}">
                    <label class="sr-only" for="state">State:</label>
                    
                            <input type="text" placeholder="State" id="state" class="form-control" name="state"
                                   value="{!! old('state') !!}"/>
                       
                    <span class="help-block">{{ $errors->first('state', ':message') }}</span>
                </div>

                <div class="form-group {{ $errors->first('city', 'has-error') }}">
                    <label class="sr-only" for="city">City:</label>
                    
                            <input type="text" placeholder="City" id="city" class="form-control" name="city"
                                   value="{!! old('city') !!}"/>
                       
                    <span class="help-block">{{ $errors->first('city', ':message') }}</span>
                </div>

                <div class="form-group {{ $errors->first('postal', 'has-error') }}">
                    <label class="sr-only" for="postal">Postal/Zip:</label>
                    
                            <input type="text" placeholder="Postal/Zip" id="postal" class="form-control"
                                   name="postal" value="{!! old('postal') !!}"/>
                        
                        <span class="help-block">{{ $errors->first('postal', ':message') }}</span>
                   
                </div>

                <div class="form-group {{ $errors->first('office_number', 'has-error') }}">
                    <label class="sr-only" for="postal">Office Number:</label>
                    <input type="text" placeholder="Office Number" id="office_number" class="form-control"
                                   name="office_number" value="{!! old('office_number') !!}"/>
                        
                        <span class="help-block">{{ $errors->first('office_number', ':message') }}</span>
                    
                </div>

                <div class="form-group {{ $errors->first('mobile_number', 'has-error') }}">
                    <label class="sr-only" for="postal">Mobile Number:</label>
                    
                    <input type="text" placeholder="Mobile Number" id="mobile_number" class="form-control"
                                   name="mobile_number" value="{!! old('mobile_number') !!}"/>
                        
                        <span class="help-block">{{ $errors->first('mobile_number', ':message') }}</span>
                    
                </div>

                <div class="form-group {{ $errors->first('bio', 'has-error') }}">
                    <label class="sr-only" for="bio">Short Description:</label>
                    
                            <textarea rows="5" cols="30"  placeholder="Short Description" id="bio" class="form-control"
                                   name="bio" >{!! old('bio') !!}</textarea>
                       
                        <span class="help-block">{{ $errors->first('bio', ':message') }}</span>
                   
                </div>

                <div class="form-group">
                    {!! captcha_img('captcha') !!} <br/>
                     <input placeholder="Please Verify" type="text" name="captcha" class="form-control">
                </div>
                <!-- <div class="form-group {{ $errors->first('gender', 'has-error') }}">
                    <label class="sr-only">Gender</label>
                    <label class="radio-inline">
                        <input type="radio" name="gender" id="inlineRadio1" value="male"> Male
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="gender" id="inlineRadio2" value="female"> Female
                    </label>
                    {!! $errors->first('gender', '<span class="help-block">:message</span>') !!}
                </div> -->
                <div class="checkbox">
                    <label>
                        <input type="checkbox" checked name="subscribed" >  I accept <a href="#"> Terms and Conditions</a>
                    </label>
                </div>
                <input type="submit" class="btn btn-block btn-default" value="Sign up" name="submit">
                Already have an account? Please <a href="{{ route('login') }}"> Sign In</a>
            </form>
                
            </div>
            <div class="modal-footer">
            
                    Already have an account? Please <a href="#" class="login" data-toggle="modal" data-target="#ModalLoginForm"> Sign In</a>
          </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div id="ModalSignupEventOrganizerForm" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">x</button>
            <h3>Event Organizer Signup</h3>
          </div>
            <div class="social">
            <ul>
                <li><a href="{{ route('organizerauth.getSocialAuth','google') }}">Register with Google</a></li>
                <li><a href="{{ route('organizerauth.getSocialAuth','facebook') }}">Register with Facebook</a></li>
                <li><a href="{{ route('organizerauth.getSocialAuth','twitter') }}">Register with Twitter</a></li>
                <li><a href="{{ route('organizerauth.getSocialAuth','linkedin') }}">Register with Linkedin</a></li>
            </ul>
        </div>
            <form action="{{ route('register-event-organizer') }}" method="POST">
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
                <div class="form-group {{ $errors->first('address', 'has-error') }}">
                    <label class="sr-only">Address</label>
                    <input placeholder="Address" type="text" class="form-control" id="add1" name="address" value="{!! old('address') !!}"/> 
                    {!! $errors->first('address', '<span class="help-block">:message</span>') !!}                           
                </div>
                 <div class="form-group {{ $errors->first('country', 'has-error') }}">
                    <label class="sr-only">Select Country: </label>
                   
                        {!! Form::select('country', $countries, old('country'),['class' => 'form-control select2', 'id' => 'countries']) !!}
                       {{ $errors->first('country', ':message') }}
                </div>

                <div class="form-group {{ $errors->first('state', 'has-error') }}">
                    <label class="sr-only" for="state">State:</label>
                    
                            <input type="text" placeholder="State" id="state" class="form-control" name="state"
                                   value="{!! old('state') !!}"/>
                       
                    <span class="help-block">{{ $errors->first('state', ':message') }}</span>
                </div>

                <div class="form-group {{ $errors->first('city', 'has-error') }}">
                    <label class="sr-only" for="city">City:</label>
                    
                            <input type="text" placeholder="City" id="city" class="form-control" name="city"
                                   value="{!! old('city') !!}"/>
                       
                    <span class="help-block">{{ $errors->first('city', ':message') }}</span>
                </div>

                <div class="form-group {{ $errors->first('postal', 'has-error') }}">
                    <label class="sr-only" for="postal">Postal/Zip:</label>
                    
                            <input type="text" placeholder="Postal/Zip" id="postal" class="form-control"
                                   name="postal" value="{!! old('postal') !!}"/>
                        
                        <span class="help-block">{{ $errors->first('postal', ':message') }}</span>
                   
                </div>

                <div class="form-group {{ $errors->first('office_number', 'has-error') }}">
                    <label class="sr-only" for="postal">Landline Number:</label>
                    <input type="text" placeholder="Landline Number" id="office_number" class="form-control"
                                   name="office_number" value="{!! old('office_number') !!}"/>
                        
                        <span class="help-block">{{ $errors->first('office_number', ':message') }}</span>
                    
                </div>

                <div class="form-group {{ $errors->first('mobile_number', 'has-error') }}">
                    <label class="sr-only" for="postal">Mobile Number:</label>
                    
                    <input type="text" placeholder="Mobile Number" id="mobile_number" class="form-control"
                                   name="mobile_number" value="{!! old('mobile_number') !!}"/>
                        
                        <span class="help-block">{{ $errors->first('mobile_number', ':message') }}</span>
                    
                </div>

                <div class="form-group {{ $errors->first('bio', 'has-error') }}">
                    <label class="sr-only" for="bio">Short Description:</label>
                    
                            <textarea rows="5" cols="30"  placeholder="Short Description" id="bio" class="form-control"
                                   name="bio" >{!! old('bio') !!}</textarea>
                       
                        <span class="help-block">{{ $errors->first('bio', ':message') }}</span>
                   
                </div>

                <div class="form-group">
                    {!! captcha_img('captcha') !!} <br/>
                     <input placeholder="Please Verify" type="text" name="captcha" class="form-control">
                </div>
                <!-- <div class="form-group {{ $errors->first('gender', 'has-error') }}">
                    <label class="sr-only">Gender</label>
                    <label class="radio-inline">
                        <input type="radio" name="gender" id="inlineRadio1" value="male"> Male
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="gender" id="inlineRadio2" value="female"> Female
                    </label>
                    {!! $errors->first('gender', '<span class="help-block">:message</span>') !!}
                </div> -->
                <div class="checkbox">
                    <label>
                        <input type="checkbox" checked name="subscribed" >  I accept <a href="#"> Terms and Conditions</a>
                    </label>
                </div>
                <input type="submit" class="btn btn-block btn-default" value="Sign up" name="submit">
                Already have an account? Please <a href="{{ route('login') }}"> Sign In</a>
            </form>
                
            </div>
            <div class="modal-footer">
            
                    Already have an account? Please <a href="#" class="login" data-toggle="modal" data-target="#ModalLoginForm"> Sign In</a>
          </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<!-- /.modal -->
<!--global js start-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="{{ asset('assets/js/eventday/bootstrap.min.js')}}"></script>
<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown menu if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
$(function(){
  $('#ModalSignupMenuForm').on('show.bs.modal', function () {
    $('.modal.in').modal('hide');
  });

  $('#ModalLoginForm').on('show.bs.modal', function () {
    $('.modal.in').modal('hide');
  });
  $('#ModalSignupBusinessForm').on('show.bs.modal', function () {
    $('.modal.in').modal('hide');
  });
  $('#ModalSignupFreelancerForm').on('show.bs.modal', function () {
    $('.modal.in').modal('hide');
  });
  $('#ModalSignupEventOrganizerForm').on('show.bs.modal', function () {
    $('.modal.in').modal('hide');
  });

});

</script>  
    <!--global js end-->
    <!-- begin page level js -->
    @yield('footer_scripts')
    <!-- end page level js -->
</body>
</html>
