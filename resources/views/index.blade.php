@extends('layouts/eventday')

{{-- Page title --}}
@section('title')
Home
@parent
@stop

@section('header_styles')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/jquery.share.css') }}"/>
@stop

@section('top')
<section class="bannerWrapper">
    <div class="container">
    <div class="row">
    <div class="col-sm-1"></div>
    <div class="col-sm-10">
    <div class="adsBanner">
      <div class="adsBannerTop"><img src="{{ asset('assets/images/eventday/ads1.jpg')}}" class="img-responsive"></div>
      <div class="adsBannerBtm">
      <div class="row">
        <div class="col-sm-4"><img src="{{ asset('assets/images/eventday/ads2.jpg')}}" class="img-responsive"></div>
        <div class="col-sm-4"><img src="{{ asset('assets/images/eventday/ads3.jpg')}}" class="img-responsive"></div>
        <div class="col-sm-4"><img src="{{ asset('assets/images/eventday/ads4.jpg')}}" class="img-responsive"></div>
      </div>
      </div>
    </div>
      <div class="navHighlight">
        <ul>
          @foreach($ads_category as $cat)
              <li><a href="{!! url('list-ads',$cat->slug) !!}">{!! $cat->name !!}</a></li>
            @endforeach
          <li><a href="{{route('ads-category')}}">More <i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
        </ul>
      </div>
      </div>
      <div class="col-sm-1"></div>
    </div>
  </div>
  <div class="searchWrap">
    <div class="container">
        <h1>What are you looking for</h1>

           <div class="col-sm-12">
            <div class="form-group">
             {!! Form::open(['url' => 'search']) !!}
              <div class="row">

                <div class="col-md-8 col-sm-8 col-xs-12 five-three">
                  <div class="row">
                    <div class="col-md-4 col-sm-4 col-xs-12">
                    
                   <label><input type="radio" name="type" value="business" checked /> Business Search</label>
                   <label><input type="radio" name="type" value="event" /> Events Search</label>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                    
                    <div class="input-group">
                      <input type="text" class="form-control" placeholder="Enter Your keyword" aria-describedby="basic-addon1" name="keyword">
                    </div>

                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12">
                    
                  <div class="input-group">
                      <input type="text" name="location" class="form-control" placeholder="Location" aria-describedby="basic-addon1">
                    </div>
                    </div><!-- end inner row -->
                  </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12 five-two">
                  <div class="row">
                    <div class="col-md-7 col-sm-7 col-xs-12">
                      <div class="input-group">
                      <input type="text" class="form-control" name="date" id='datepicker' placeholder="Date" aria-describedby="basic-addon1">
                      <span class="input-group-addon" id="basic-addon2"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                    </div>
                    </div>
                    <div class="col-md-5 col-sm-5 col-xs-12">
                      <button type="submit" class="btn btn-secondary searchBtn">Search</button>
                      <!-- <a href="#" class="advSearch"> Advance Search </a> -->
                    </div>
                  </div><!-- end inner row -->
                </div>
              </div><!-- end outer row -->
              {!! Form::close() !!}
              </div>
               </div>
    </div>
  </div>
</section>
@stop

@section('content')
<section class="mainContainer">
<div class="contantWrapper">
    <div class="container">
      <div class="row">
        <h2><span>Welcome to EventdayPlanner</span></h2>
        <div class="welcomeTxt">If you are looking for live wedding music at your ceremony, or to find a performer who will amaze the guests at your drinks reception, you are in the right place! Warble Entertainment provides musicians, such as string quartets and harpists who are perfect to create a romantic ambience, and unique and fun wedding entertainment ideas with magicians, caricaturists and more!</div>
      </div>
      <div class="searchContent">
      <div class="row">
      <div class="filterSearch">
        <div class="col-sm-9">
        <h3>Upcomming events</h3></div>
        <div class="col-sm-3">
        <div class="fliterR">
        <div class="filter"> Filter by </div>
        {!! Form::open(['url' => 'filtereventbyprice']) !!}
        <select id="price" name="price" class="form-control" onchange="this.form.submit()">
                    <option>Price</option>
                    <option value="10">Below {!! Helper::getPricesymbol() !!} 10</option>
                    <option value="50">Below {!! Helper::getPricesymbol() !!} 50</option>
                    <option value="100">Below {!! Helper::getPricesymbol() !!} 100</option>
                    <option value="200">Below {!! Helper::getPricesymbol() !!} 200</option>
                    <option value="-1">All</option>
        </select>
        {!! Form::close() !!}
        </div>
        </div>
      </div>
      </div>
      <div class="row">
        <div class="boxContent">
    @foreach($events as $event)
      <div class="col-md-4 col-sm-4 col-xs-12">
        <div class="panel panel-default">
            <div class="panel-image">
              <div class="eventPrice">Price: {!! Helper::getPrice($event->ticket_price) !!}</div>
              <div class="eventLogoWrap"><div class="eventlogo"><img class="img-responsive img-circle" src="{{url('user_circularthumb',$event->organizer()->first()->pic)}}"/></div></div>
              <a href="{{ URL::to('event/'.$event->slug) }}">
                @if($event->photo)
                <img class="img-responsive img-hover" src="thumbnail2/{!! $event->photo !!}" alt="">
                @else
                <img class="img-responsive img-hover" src="thumbnail2/lfgRuzbVrvzTfc2vwqnJ.jpg" alt="">
                @endif
                </a>

            
            </div>
             <div class="panel-body">
              <div class="time"> <i class="fa fa-clock-o" aria-hidden="true"></i>
              {!! date('D, M d, g a ',strtotime($event->date)) !!}</div>
              <h3>{!! $event->name !!}</h3>
              <!-- <div class="date">Date 25th June2016</div> -->
              <div class="address"><i class="fa fa-map-marker" aria-hidden="true"></i> {!! $event->location !!}</div>
                  <p><!-- {!! str_limit($event->description,150, '...') !!} --></p>
              <div class="property-meta">
              <ul>
                <li><a href="{{ URL::to('event/'.$event->slug) }}"><i class="fa fa-info-circle" aria-hidden="true"></i> More Info</a></li>
                <li class="centerShare">

                <p class="text-center">
        <button type="button"  class=" btn-share btn btn-simple popover-html" data-text="{{$event->name}}" data-link="{{ URL::to('event/'.$event->slug) }}" data-container="body" data-toggle="popover" data-placement="top">
          
           <span>Share</span> <i class="fa fa-share-alt" aria-hidden="true"></i>
          
        </button>
        <!-- Popover hidden content -->
        <span id="popoverExampleHiddenContent" class="hidden">
          <a target="_blank" href="#" class="btn-media twitter">
            <i class="fa fa-twitter"></i>
          </a>
          <a target="_blank" href="#" class="btn-media facebook">
            <i class="fa fa-facebook"></i>
          </a>
          <a target="_blank" href="#" class="btn-media google-plus">
            <i class="fa fa-google-plus"></i>
          </a>
          <a target="_blank" href="#" class="btn-media pinterest">
            <i class="fa fa-pinterest"></i>
          </a>
          <a target="_blank" href="#" class="btn-media envelope">
            <i class="fa fa-envelope"></i>
          </a>
        </span>
      </p>
                
                </li>
                <li class="pull-right"> <a href="{{ url('events/book',$event->id) }}"><i class="fa fa-ticket" aria-hidden="true"></i> Book Tickets</a></li>
              </ul>
              </div>
            </div>
        </div>
      </div>
    @endforeach
        </div>
      </div>
      </div>
      <div class="newSetion">
        <div class="row">
          <div class="col-sm-4">
          <h3>latest News</h3>
          @foreach($news as $newsitem)
          <p><a href="{{ URL::to('newsitem/'.$newsitem->slug) }}"><strong> {{$newsitem->title}} </strong>
          <span> {{$newsitem->created_at->diffForHumans()}}</span>
          
          {!! str_limit($newsitem->content,150, '...') !!}
          </a></p>
          @endforeach

                    
          </div>
          <div class="col-sm-4">
            <h3>Popular Events</h3>
            @if(count($popularevents))
              @foreach($popularevents as $event)
                <p style="min-height: 100px;">
                @if($event->photo)
                <img class="img-responsive img-hover" src="thumbnail3/{!! $event->photo !!}" alt="">
                @else
                 <img src="{{ asset('assets/images/eventday/news1.jpg')}}" alt="">
                @endif

                <a href="{{ URL::to('event/'.$event->slug) }}"><strong> {!! $event->name !!} </strong>
               {!! str_limit($event->description,100, '...') !!}
                </a></p>
              @endforeach
            @endif
          
          </div>
          
          <div class="col-sm-4">
            <h3>Sponsored Events</h3>
            @if(count($sponsoredevents))
              @foreach($sponsoredevents as $event)
              <p style="min-height: 100px;">
                @if($event->photo)
                <img class="img-responsive img-hover" src="thumbnail3/{!! $event->photo !!}" alt="">
                @else
                 <img src="{{ asset('assets/images/eventday/news1.jpg')}}" alt="">
                @endif

                <a href="{{ URL::to('event/'.$event->slug) }}"><strong> {!! $event->name !!} </strong>
               {!! str_limit($event->description,100, '...') !!}
                </a></p>
              @endforeach
            @endif
          
          </div>
        </div>
      </div>
    </div>
</div>
</section>
<section class="contantWrapper testimonial">
  <div class="container">
    <div class="row">
      <div class="col-xs-3"><span class="borderBtm"></span></div>
      <div class="col-xs-6">
        <h2 class="noBorder"><span>What People Think</span></h2>
      </div>
      <div class="col-xs-3"><span class="borderBtm"></span></div>
    </div>
    <div class="row"> 
      
      <!-- <h2 class="padT6px"><span class="testiBG">What People Think</span></h2> -->
      
      <div class="col-sm-2">
        <p><i class="fa fa-quote-left" aria-hidden="true"></i></p>
      </div>
      <div class="col-sm-8">
        <p>{{ $testimonial->description}}<span><strong>{{ $testimonial->name}}</strong><br>
         {{ $testimonial->title }}<br>
          {{ $testimonial->company }}</span></p>
      </div>
      <div class="col-sm-2"></div>
    </div>
  </div>
</section>
@stop

@section('footer_scripts')
<!-- page level js starts-->
    
    <script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
    <script type="text/javascript" src="{{ asset('assets/js/frontend/jquery.share.js') }}"></script>
    <script src="{{ asset('assets/js/eventday/moment.js') }}"></script>
    <script>
    var link=window.location.href;
    var text="eventdayplanner.com";
    $(".btn-share").popover({
      html : true, 
      container : '.btn-share',
      content: function() {
        return $('#popoverExampleHiddenContent').html();
      },
      template: '<div class="popover" role="tooltip"><div class="popover-content"></div></div>'
    });

    $('.btn-share').click(function (event) {
      $('.btn-share').not(this).popover('hide');
        text=($(this).data('text'));
        link=($(this).data('link'));
         $("a.twitter").attr("href", "https://twitter.com/home?status=" + link+"&text=" + text);
        $("a.facebook").attr("href", "https://www.facebook.com/sharer/sharer.php?u=" + link +"&title=" + text);
        $("a.google-plus").attr("href", "https://plus.google.com/share?url=" + link +"&content="+text);
        $("a.pinterest").attr("href", "https://plus.google.com/share?url=" + link+"&description=" + text);
        $("a.envelope").attr("href", "mailto:?subject="+ text +"&body=" + link);
       
            // hide share button popover
            if (!$(event.target).closest('.btn-share').length) {
                $('.btn-share').popover('hide')
            }
        });

   

   

    $( function() {
        $( "#datepicker" ).datepicker({dateFormat: 'yy-mm-dd'});
    } );
</script>
    <!--page level js ends-->
@stop



{{-- page level styles --}}
@section('header_styles_comingsoon')
    <!--page level css starts-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/tabbular.css') }}">
<link href="{{ asset('assets/vendors/animate/animate.min.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/jquery.circliful.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/owl.carousel/css/owl.carousel.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/owl.carousel/css/owl.theme.css') }}">
    <!--end of page level css-->
@stop

{{-- slider --}}
@section('top_comingsoon')
    <!--Carousel Start -->
    <div id="owl-demo" class="owl-carousel owl-theme">
        <div class="item"><img src="{{ asset('assets/images/slide_1.jpg') }}" alt="slider-image">
        </div>
        <div class="item"><img src="{{ asset('assets/images/slide_2.jpg') }}" alt="slider-image">
        </div>
        <div class="item"><img src="{{ asset('assets/images/slide_3.jpg') }}" alt="slider-image">
        </div>
    </div>
    <!-- //Carousel End -->
@stop

{{-- content --}}
@section('content_comingsoon')
    <div class="container">
        <section class="purchas-main">
            <div class="container bg-border wow pulse" data-wow-duration="2.5s">
                <div class="row">
                    <div class="col-md-7 col-sm-7 col-xs-12">
                        <h1 class="purchae-hed">Excellent admin template for laravel</h1></div>
                    <div class="col-md-5 col-sm-5 col-xs-12"><a href="#" class="btn btn-primary purchase-styl pull-right">Purchase now</a></div>
                </div>
            </div>
        </section>
        <!-- Service Section Start-->
        <div class="row">
            <!-- Responsive Section Start -->
            <div class="text-center">
                <h3 class="border-primary"><span class="heading_border bg-primary">Our Services</span></h3>
            </div>
            <div class="col-sm-6 col-md-3 wow bounceInLeft" data-wow-duration="3.5s">
                <div class="box">
                    <div class="box-icon">
                        <i class="livicon icon" data-name="desktop" data-size="55" data-loop="true" data-c="#01bc8c" data-hc="#01bc8c"></i>
                    </div>
                    <div class="info">
                        <h3 class="success text-center">Responsive</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corrupti atque, tenetur quam aspernatur corporis at explicabo nulla dolore necessitatibus doloremque exercitationem sequi dolorem architecto perferendis quas aperiam debitis dolor soluta!</p>
                        <div class="text-right primary"><a href="#">Read more</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- //Responsive Section End -->
            <!-- Easy to Use Section Start -->
            <div class="col-sm-6 col-md-3 wow bounceInDown" data-wow-duration="3s" data-wow-delay="0.4s">
                <!-- Box Start -->
                <div class="box">
                    <div class="box-icon box-icon1">
                        <i class="livicon icon1" data-name="gears" data-size="55" data-loop="true" data-c="#418bca" data-hc="#418bca"></i>
                    </div>
                    <div class="info">
                        <h3 class="primary text-center">Easy to Use</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corrupti atque, tenetur quam aspernatur corporis at explicabo nulla dolore necessitatibus doloremque exercitationem sequi dolorem architecto perferendis quas aperiam debitis dolor soluta!.</p>
                        <div class="text-right primary"><a href="#">Read more</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- //Easy to Use Section End -->
            <!-- Clean Design Section Start -->
            <div class="col-sm-6 col-md-3 wow bounceInUp" data-wow-duration="3s" data-wow-delay="0.8s">
                <div class="box">
                    <div class="box-icon box-icon2">
                        <i class="livicon icon1" data-name="doc-portrait" data-size="55" data-loop="true" data-c="#f89a14" data-hc="#f89a14"></i>
                    </div>
                    <div class="info">
                        <h3 class="warning text-center">Clean Design</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corrupti atque, tenetur quam aspernatur corporis at explicabo nulla dolore necessitatibus doloremque exercitationem sequi dolorem architecto perferendis quas aperiam debitis dolor soluta!</p>
                        <div class="text-right primary"><a href="#">Read more</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- //Clean Design Section End -->
            <!-- 20+ Page Section Start -->
            <div class="col-sm-6 col-md-3 wow bounceInRight" data-wow-duration="5s" data-wow-delay="1.2s">
                <div class="box">
                    <div class="box-icon box-icon3">
                        <i class="livicon icon1" data-name="folder-open" data-size="55" data-loop="true" data-c="#FFD43C" data-hc="#FFD43C"></i>
                    </div>
                    <div class="info">
                        <h3 class="yellow text-center">20+ Pages</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corrupti atque, tenetur quam aspernatur corporis at explicabo nulla dolore necessitatibus doloremque exercitationem sequi dolorem architecto perferendis quas aperiam debitis dolor soluta!</p>
                        <div class="text-right primary"><a href="#">Read more</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- //20+ Page Section End -->
        </div>
        <!-- //Services Section End -->
    </div>
    <!-- Layout Section Start -->
    <section class="feature-main">
        <div class="container">
            <div class="row">

                <div class="col-md-9 col-sm-9 col-xs-12 wow zoomIn" data-wow-duration="3s">
                    <div class="layout-image">
                        <img src="{{ asset('assets/images/layout.png') }}" alt="layout" class="img-responsive" />
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12 wow lightSpeedIn" data-wow-duration="1.5s">
                    <ul class="list-unstyled pull-right text-right layout-styl">
                        <li>
                            <i class="livicon" data-name="checked-on" data-size="20" data-loop="true" data-c="#01bc8c" data-hc="#01bc8c"></i> Responsive clean design
                        </li>
                        <li><i class="livicon" data-name="checked-on" data-size="20" data-loop="true" data-c="#01bc8c" data-hc="#01bc8c"></i> User friendly </li>
                        <li><i class="livicon" data-name="checked-on" data-size="20" data-loop="true" data-c="#01bc8c" data-hc="#01bc8c"></i> HTML5 </li>
                        <li><i class="livicon" data-name="checked-on" data-size="20" data-loop="true" data-c="#01bc8c" data-hc="#01bc8c"></i> CSS3 </li>
                        <li><i class="livicon" data-name="checked-on" data-size="20" data-loop="true" data-c="#01bc8c" data-hc="#01bc8c"></i> Bootstrap 3.3.4 </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <!-- //Layout Section Start -->
    <!-- Accordions Section End -->
    <div class="container">
        <div class="row">
            <!-- Accordions Start -->
            <div class="text-center wow flash" data-wow-duration="3s">
                <h3 class="border-success"><span class="heading_border bg-success">Accordions</span></h3>
                <label class=" text-center"> Lorem Ipsum is simply dummy text of the printing and typesetting industry.</label>
            </div>
            <!-- Accordions End -->
            <div class="col-md-6 col-sm-12 wow slideInLeft" data-wow-duration="1.5s">
                <!-- Tabbable-Panel Start -->
                <div class="tabbable-panel">
                    <!-- Tabbablw-line Start -->
                    <div class="tabbable-line">
                        <!-- Nav Nav-tabs Start -->
                        <ul class="nav nav-tabs ">
                            <li class="active">
                                <a href="#tab_default_1" data-toggle="tab">
                                Web </a>
                            </li>
                            <li>
                                <a href="#tab_default_2" data-toggle="tab">
                                Html 5 </a>
                            </li>
                            <li>
                                <a href="#tab_default_3" data-toggle="tab">
                                CSS 3 </a>
                            </li>
                            <li>
                                <a href="#tab_default_4" data-toggle="tab">
                                Bootstrap </a>
                            </li>
                        </ul>
                        <!-- //Nav Nav-tabs End -->
                        <!-- Tab-content Start -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_default_1">
                                <div class="media">
                                    <div class="media-left tab col-sm-12">
                                        <a href="#">
                                            <img class="media-object img-responsive" src="{{ asset('assets/images/authors/img1.jpg') }}" alt="image">
                                        </a>
                                    </div>
                                </div>
                                <p>
                                    Metrics business-to-business beta bootstrapping virality graphical user interface infrastructure conversion launch party long tail. Strategy virality validation bandwidth creative low hanging fruit long tail startup gen-z business plan technology. Strategy termsheet venture stealth non-disclosure agreement accelerator research & development scrum project product management freemium infographic business plan.
                                </p>
                            </div>
                            <div class="tab-pane" id="tab_default_2">
                                <div class="media">
                                    <div class="media-left media-middle tab col-sm-12">
                                        <a href="#">
                                            <img class="media-object img-responsive" src="{{ asset('assets/images/authors/img2.jpg') }}" alt="image">
                                        </a>
                                    </div>
                                </div>
                                <p>
                                    Branding iteration conversion market sales advisor holy grail entrepreneur backing. Gen-z non-disclosure agreement holy grail business-to-consumer disruptive deployment marketing channels seed money seed round ramen pivot social proof. Venture creative metrics focus A/B testing crowdfunding. IPhone scrum project user experience freemium interaction design long tail stealth ownership hackathon crowdfunding investor.
                                </p>
                            </div>
                            <div class="tab-pane" id="tab_default_3">
                                <div class="media">
                                    <div class="media-left media-middle tab col-sm-12">
                                        <a href="#">
                                            <img class="media-object img-responsive" src="{{ asset('assets/images/authors/img3.jpg') }}" alt="image">
                                        </a>
                                    </div>
                                </div>
                                <p>
                                     Beta analytics startup direct mailing leverage learning curve www.discoverartisans.com business-to-consumer. IPad metrics channels pivot deployment business plan android burn rate hackathon vesting period research & development launch party user experience. Seed round freemium value proposition learning curve series A financing funding research & development crowdsource. 
                                </p>
                            </div>
                            <div class="tab-pane" id="tab_default_4">
                                <div class="media">
                                    <div class="media-left media-middle tab col-sm-12">
                                        <a href="#">
                                            <img class="media-object img-responsive" src="{{ asset('assets/images/authors/img4.jpg') }}" alt="image">
                                        </a>
                                    </div>
                                </div>
                                <p>
                                    Paradigm shift twitter pitch research & development venture. Startup partnership www.discoverartisans.com supply chain crowdsource hackathon metrics paradigm shift interaction design influencer holy grail first mover advantage ramen validation. User experience founders burn rate learning curve infographic leverage gen-z supply chain first mover advantage. 
                                </p>
                            </div>
                        </div>
                        <!-- Tab-content End -->
                    </div>
                    <!-- //Tabbablw-line End -->
                </div>
                <!-- Tabbable_panel End -->
            </div>
            <div class="col-md-6 col-sm-12 wow slideInRight" data-wow-duration="3s">
                <!-- Panel-group Start -->
                <div class="panel-group" id="accordion">
                    <!-- Panel Panel-default Start -->
                    <div class="panel panel-default">
                        <!-- Panel-heading Start -->
                        <div class="panel-heading text_bg">
                            <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                <span class=" glyphicon glyphicon-minus success"></span>
                                <span class="success">Why Choose Us</span></a>
                            </h4>
                        </div>
                        <!-- //Panel-heading End -->
                        <!-- Collapseone Start -->
                        <div id="collapseOne" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <p>In 1972 a crack commando unit was sent to prison by a military court for a crime they didn't commit. These men promptly escaped from a maximum security stockade to the Los Angeles underground. Believe it or not I'm walking on air. I never thought I could feel so free. Flying away on a wing and a prayer. Who could it be? Believe it or not its just me. Come and knock on our door. We've been waiting for you. Where the kisses are hers and hers and his. Three's company too. Flying away on a wing and a prayer. Who could it be? Believe it or not its just me. Here's the story of a man named Brady who was busy with three boys of his own. One two three four five six seven eight Sclemeel schlemazel hasenfeffer incorporated? Till the one day when the lady met this fellow and they knew it was much more than a hunch. Baby if you've ever wondered.
                                </p>
                            </div>
                        </div>
                        <!-- Collapseone End -->
                    </div>
                    <!-- //Panel Panel-default End -->
                    <div class="panel panel-default">
                        <div class="panel-heading text_bg">
                            <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                <span class=" glyphicon glyphicon-plus success"></span>
                                <span class="success">Why Choose Us</span>
                            </a>
                        </h4>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse">
                            <div class="panel-body">
                                <p>
                                    In 1972 a crack commando unit was sent to prison by a military court for a crime they didn't commit. These men promptly escaped from a maximum security stockade to the Los Angeles underground. Believe it or not I'm walking on air. I never thought I could feel so free. Flying away on a wing and a prayer. Who could it be? Believe it or not its just me. Come and knock on our door. We've been waiting for you. Where the kisses are hers and hers and his. Three's company too. Flying away on a wing and a prayer. Who could it be? Believe it or not its just me. Here's the story of a man named Brady who was busy with three boys of his own. One two three four five six seven eight Sclemeel schlemazel hasenfeffer incorporated? Till the one day when the lady met this fellow and they knew it was much more than a hunch. Baby if you've ever wondered.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading text_bg">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                <span class=" glyphicon glyphicon-plus success"></span>
                                <span class="success">Why Choose Us</span></a>
                            </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse">
                            <div class="panel-body">
                                <p>
                                    In 1972 a crack commando unit was sent to prison by a military court for a crime they didn't commit. These men promptly escaped from a maximum security stockade to the Los Angeles underground. Believe it or not I'm walking on air. I never thought I could feel so free. Flying away on a wing and a prayer. Who could it be? Believe it or not its just me. Come and knock on our door. We've been waiting for you. Where the kisses are hers and hers and his. Three's company too. Flying away on a wing and a prayer. Who could it be? Believe it or not its just me. Here's the story of a man named Brady who was busy with three boys of his own. One two three four five six seven eight Sclemeel schlemazel hasenfeffer incorporated? Till the one day when the lady met this fellow and they knew it was much more than a hunch. Baby if you've ever wondered.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- //Panle-group End -->
            </div>
        </div>
        <!-- //Accordions Section End -->
        <!-- Our Team Start -->
        <div class="row text-center">
            <h3 class=" border-danger"><span class="heading_border bg-danger">Our Team</span></h3>
            <div class="col-md-3 col-sm-5 profile wow fadeInLeft" data-wow-duration="3s">
                <div class="thumbnail bg-white">
                    <img src="{{ asset('assets/images/img_3.jpg') }}" alt="team-image" class="img-responsive">
                    <div class="caption">
                        <b>John Doe</b>
                        <br /> Founder & Partner
                        <br />
                        <div class="divide">
                            <a href="#" class="divider"> <i class="livicon" data-name="facebook" data-size="22" data-loop="true" data-c="#3a5795" data-hc="#3a5795"></i>
                            </a>
                            <a href="#"> <i class="livicon" data-name="twitter" data-size="22" data-loop="true" data-c="#55acee" data-hc="#55acee"></i>
                            </a>
                            <a href="#"> <i class="livicon" data-name="google-plus" data-size="22" data-loop="true" data-c="#d73d32" data-hc="#d73d32"></i>
                            </a>
                            <a href="#"> <i class="livicon" data-name="linkedin" data-size="22" data-loop="true" data-c="#1b86bd" data-hc="#1b86bd"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-5 profile wow fadeInUp" data-wow-duration="3s" data-wow-delay="0.5s">
                <div class="thumbnail bg-white">
                    <img src="{{ asset('assets/images/img_5.jpg') }}" alt="team-image">
                    <div class="caption">
                        <b>Francina Steinberg</b>
                        <br /> CEO
                        <br />
                        <div class="divide">
                            <a href="#" class="divider"> <i class="livicon" data-name="facebook" data-size="22" data-loop="true" data-c="#3a5795" data-hc="#3a5795"></i>
                            </a>
                            <a href="#"> <i class="livicon" data-name="twitter" data-size="22" data-loop="true" data-c="#55acee" data-hc="#55acee"></i>
                            </a>
                            <a href="#"> <i class="livicon" data-name="google-plus" data-size="22" data-loop="true" data-c="#d73d32" data-hc="#d73d32"></i>
                            </a>
                            <a href="#"> <i class="livicon" data-name="linkedin" data-size="22" data-loop="true" data-c="#1b86bd" data-hc="#1b86bd"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-5 profile wow fadeInDown" data-wow-duration="3s" data-wow-delay="1s">
                <div class="thumbnail bg-white">
                    <img src="{{ asset('assets/images/img_4.jpg') }}" alt="team-image" class="img-responsive">
                    <div class="caption">
                        <b>Audrey Sheldon</b>
                        <br /> Executive Manager
                        <br />
                        <div class="divide">
                            <a href="#" class="divider"> <i class="livicon" data-name="facebook" data-size="22" data-loop="true" data-c="#3a5795" data-hc="#3a5795"></i>
                            </a>
                            <a href="#"> <i class="livicon" data-name="twitter" data-size="22" data-loop="true" data-c="#55acee" data-hc="#55acee"></i>
                            </a>
                            <a href="#"> <i class="livicon" data-name="google-plus" data-size="22" data-loop="true" data-c="#d73d32" data-hc="#d73d32"></i>
                            </a>
                            <a href="#"> <i class="livicon" data-name="linkedin" data-size="22" data-loop="true" data-c="#1b86bd" data-hc="#1b86bd"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-5 profile wow fadeInRight" data-wow-duration="3s" data-wow-delay="1.5s">
                <div class="thumbnail bg-white">
                    <img src="{{ asset('assets/images/img_6.jpg') }}" alt="team-image">
                    <div class="caption">
                        <b>Sam Bellows</b>
                        <br /> Manager
                        <br />
                        <div class="divide">
                            <a href="#" class="divider"> <i class="livicon" data-name="facebook" data-size="22" data-loop="true" data-c="#3a5795" data-hc="#3a5795"></i>
                            </a>
                            <a href="#"> <i class="livicon" data-name="twitter" data-size="22" data-loop="true" data-c="#55acee" data-hc="#55acee"></i>
                            </a>
                            <a href="#"> <i class="livicon" data-name="google-plus" data-size="22" data-loop="true" data-c="#d73d32" data-hc="#d73d32"></i>
                            </a>
                            <a href="#"> <i class="livicon" data-name="linkedin" data-size="22" data-loop="true" data-c="#1b86bd" data-hc="#1b86bd"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- //Our Team End -->
        <!-- What we are section Start -->
        <div class="row">
            <!-- What we are Start -->
            <div class="col-md-6 col-sm-6 wow zoomInLeft" data-wow-duration="3s">
                <div class="text-left">
                    <div>
                        <h4 class="border-warning"><span class="heading_border bg-warning">What We Are</span></h4>
                    </div>
                </div>
                <img src="{{ asset('assets/images/image_12.jpg') }}" alt="image_12" class="img-responsive">
                <p>
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                </p>
                <p>
                    <div class="text-right primary"><a href="#">Read more</a></div>
                </p>
            </div>
            <!-- //What we are End -->
            <!-- About Us Start -->
            <div class="col-md-6 col-sm-6 wow zoomInRight" data-wow-duration="3s">
                <div class="text-left">
                    <div>
                        <h4 class="border-success"><span class="heading_border bg-success">About Us</span></h4>
                    </div>
                </div>
                <img src="{{ asset('assets/images/image_11.jpg') }}" alt="image_11" class="img-responsive">
                <p>
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                </p>
                <p>
                    <div class="text-right primary"><a href="#">Read more</a>
                    </div>
                </p>
            </div>
            <!-- //About Us End -->
        </div>
        <!-- //What we are section End -->
        <!-- Testimonial Start -->
        <div class="row">
            <!-- Testimonial Section -->
            <div class="text-center">
                <h3 class="border-primary"><span class="heading_border bg-primary">Testimonials</span></h3>
            </div>
            <div class="col-md-4 wow bounceInLeft" data-wow-duration="3s">
                <div class="author">
                    <img src="{{ asset('assets/images/authors/avatar3.jpg') }}" alt="avatar3" class="img-responsive img-circle pull-left">
                    <p class="text-right">
                        Tonny Jakson
                        <br>
                        <small class="text-right">Themeforest.net</small>
                    </p>
                    <p>
                        <label>"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."</label>
                    </p>
                </div>
            </div>
            <div class="col-md-4 wow bounceIn" data-wow-duration="3s">
                <div class="author">
                    <img src="{{ asset('assets/images/authors/avatar2.jpg') }}" alt="avatar2" class="img-responsive img-circle pull-left">
                    <p class="text-right">
                        Tonny Jakson
                        <br>
                        <small class="text-right">Themeforest.net</small>
                    </p>
                    <p>
                        <label>"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."</label>
                    </p>
                </div>
            </div>
            <div class="col-md-4 wow bounceInRight" data-wow-duration="3s">
                <div class="author">
                    <img src="{{ asset('assets/images/authors/avatar4.jpg') }}" alt="avatar4" class="img-responsive img-circle pull-left">
                    <p class="text-right">
                        Tonny Jakson
                        <br>
                        <small class="text-right">Themeforest.net</small>
                    </p>
                    <p>
                        <label>"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."</label>
                    </p>
                </div>
            </div>
            <!-- Testimonial Section End -->
        </div>
        <!-- Testimonial End -->
        <!-- Features Start -->
        <div class="row features">
            <div class="text-center">
                <div class="text-center">
                    <h3 class=" border-warning"><span class="heading_border bg-warning">Features</span></h3>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 wow fadeInDown" data-wow-duration="3s">
                <div>
                    <a href="#"><i class="livicon" data-name="checked-on" data-size="22" data-loop="true" data-c="#25a3d8" data-hc="#25a3d8"></i></a>
                    <h4><bold>Responsive Design</bold></h4>
                </div>
                <div>
                    <p>
                        <label>"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."</label>
                    </p>
                </div>
                <div>
                    <a href="#"> <i class="livicon" data-name="checked-on" data-size="22" data-loop="true" data-c="#ef8424 " data-hc="#ef8424 "></i>
                    </a>
                    <h4><bold>Html 5</bold></h4>
                    <p>
                        <label>"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."</label>
                    </p>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 wow fadeInDown" data-wow-duration="3s" data-wow-delay="0.8s">
                <div>
                    <a href="#"> <i class="livicon" data-name="checked-on" data-size="22" data-loop="true" data-c="#01bc8c" data-hc="#01bc8c"></i>
                    </a>
                    <h4><bold>Unique Design</bold></h4>
                    <p>
                        <label>"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."</label>
                    </p>
                </div>
                <div>
                    <a href="#"> <i class="livicon" data-name="checked-on" data-size="22" data-loop="true" data-c="#1360b3 " data-hc="#1360b3 "></i>
                    </a>
                    <h4><bold>Css</bold></h4>
                    <p>
                        <label>"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."</label>
                    </p>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 wow fadeInDown" data-wow-duration="3s" data-wow-delay="1.2s">
                <div>
                    <a href="#"> <i class="livicon" data-name="checked-on" data-size="22" data-loop="true" data-c="#FFD43C" data-hc="#FFD43C"></i>
                    </a>
                    <h4>Clean Design</h4>
                    <p>
                        <label>"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."</label>
                    </p>
                </div>
                <div>
                    <a href="#"> <i class="livicon" data-name="checked-on" data-size="22" data-loop="true" data-c="#91d659 " data-hc="#91d659 "></i>
                    </a>
                    <h4>Bootstrap</h4>
                    <p>
                        <label>"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."</label>
                    </p>
                </div>
            </div>
        </div>
        <!-- //Features End -->
        <!-- Our Skills Start -->
        
        <div class="text-center marbtm10">
            <h3 class="border-danger"><span class="heading_border bg-danger">Our Skills</span></h3>
        </div>
            </div>
        <div class="sliders">
            <!-- Our skill Section start -->
            <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6 text-center wow zoomIn" data-wow-duration="3.5s">
                <div class="text-center center-block">
                    <div id="myStat3" class="center-block" data-startdegree="0" data-dimension="150" data-text="90%" data-width="4" data-fontsize="28" data-percent="90" data-fgcolor="#3abec0" data-bgcolor="#eee"></div>
                    <strong class="success">Bootstrap</strong>
                </div>
                <span>Lorem Ipsum is simply dummy text of the printing and type setting industry</span>
            </div>
                <div class="col-md-3 col-sm-6 text-center wow zoomIn" data-wow-duration="3s" data-wow-delay="0.8s">
                <div class="text-center center-block">
                    <div id="myStat4" class="center-block" data-startdegree="0" data-dimension="150" data-text="60%" data-width="4" data-fontsize="28" data-percent="60" data-fgcolor="#3abec0" data-bgcolor="#eee"></div>
                    <strong class="success">Jquery</strong>
                </div>
                <span>Lorem Ipsum is simply dummy text of the printing and typesetting industry</span>
            </div>
                <div class="col-md-3 col-sm-6 text-center wow zoomIn" data-wow-duration="3s" data-wow-delay="1.2s">
                <div class="text-center center-block">
                <div id="myStat5" class="center-block" data-startdegree="0" data-dimension="150" data-text="100%" data-width="4" data-fontsize="28" data-percent="100" data-fgcolor="#3abec0" data-bgcolor="#eee"></div>
                <strong class="success">Html 5</strong>
            </div>
            <span>Lorem Ipsum is simply dummy text of the printing and typesetting industry</span>
            </div>
                <div class="col-md-3 col-sm-6 text-center wow zoomIn" data-wow-duration="3s" data-wow-delay="1.8s">
                <div class="text-center center-block">
                <div id="myStat6" class="center-block" data-startdegree="0" data-dimension="150" data-text="70%" data-width="4" data-fontsize="28" data-percent="70" data-fgcolor="#3abec0" data-bgcolor="#eee"></div>
                <strong class="success">CSS 3</strong>
            </div>
            <span>Lorem Ipsum is simply dummy text of the printing and typesetting industry</span>
            </div>
        </div>
            <!-- Our skills Section End -->
        </div>
        <!-- //Our Skills End -->
    </div>
    <!-- //Container End -->
@stop

{{-- footer scripts --}}
@section('footer_scripts_comingsoon')
    <!-- page level js starts-->
    
    <script type="text/javascript" src="{{ asset('assets/js/frontend/jquery.circliful.js') }}"></script>
    <script src="{{ asset('assets/vendors/wow/js/wow.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/owl.carousel/js/owl.carousel.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/frontend/carousel.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/frontend/index.js') }}"></script>
    <script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>

    <script>
    $( function() {
    $( "#datepicker" ).datepicker({dateFormat: 'yy-mm-dd'});
  } );
    </script>
    <!--page level js ends-->

    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
     
                              <div class="customerSocial">
                            
                              <i class="fa fa-facebook-square" aria-hidden="true"></i>

                              <i class="fa fa-twitter-square" aria-hidden="true"></i>
                              <i class="fa fa-pinterest-square" aria-hidden="true"></i>
                              <i class="fa fa-envelope-square" aria-hidden="true"></i>
                            </div>
    </div>
  </div>
</div>
@stop
