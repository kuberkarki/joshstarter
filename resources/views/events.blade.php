@extends('layouts/eventday')

{{-- Page title --}}
@section('title')
event
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <!--page level css starts-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/tabbular.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/blog.css') }}">
    <!--end of page level css-->
@stop

{{-- breadcrumb --}}
@section('top')
    <div class="breadcum">
        <div class="container ">
            <ol class="breadcrumb">
                <li>
                    <a href="{{ route('home') }}"> <i class="livicon icon3 icon4" data-name="home" data-size="18" data-loop="true" data-c="#3d3d3d" data-hc="#3d3d3d"></i>Dashboard
                    </a>
                </li>
                <li class="hidden-xs">
                    <i class="livicon icon3" data-name="angle-double-right" data-size="18" data-loop="true" data-c="#01bc8c" data-hc="#01bc8c"></i>
                    <a href="{{ route('events') }}">Events</a>
                </li>
            </ol>
            <div class="pull-right">
                <i class="livicon icon3" data-name="edit" data-size="20" data-loop="true" data-c="#3d3d3d" data-hc="#3d3d3d"></i> Events
            </div>
        </div>
    </div>
    @stop


{{-- Page content --}}
@section('content')
    <!-- Container Section Strat -->
    <div class="container textsmall">
        <h2>Events</h2>
        <div class="row">
            <div class="content">
                <div class="col-md-8">
                    @forelse ($events as $event)
                    <!-- BEGIN FEATURED POST -->
                    <div class="featured-post-wide thumbnail">
                        @if($event->photo)
                        <img src="{{ URL::to('/mainphoto/'.$event->photo)  }}" class="img-responsive" alt="Image">
                        @endif
                        <div class="featured-text relative-left">
                            <h3 class="primary"><a href="{{ URL::to('eventitem/'.$event->slug) }}">{{$event->name}}</a></h3>
                            <p>
                                {!! $event->description !!}
                            </p>
                            <p>
                                <strong>Tags: </strong>
                                @forelse($event->tags as $tag)
                                    <a href="{{ URL::to('event/'.mb_strtolower($tag).'/tag') }}">{{ $tag }}</a>,
                                @empty
                                    No Tags
                                @endforelse
                            </p>
                            
                            <hr>
                            <p class="text-right">
                                <a href="{{ URL::to('event/'.$event->slug) }}" class="btn btn-primary text-white">Read more</a>
                            </p>
                        </div>
                        <!-- /.featured-text -->
                    </div>
                    <!-- /.featured-post-wide -->
                    <!-- END FEATURED POST -->
                    @empty
                        <h3>No Events Exists!</h3>
                    @endforelse
                    <ul class="pager">
                        {!! $events->render() !!}
                    </ul>
                </div>
                <!-- /.col-md-8 -->
                <div class="col-md-4">
                    <!-- END POPULAR POST -->
                    <!-- Tabbable-Panel Start -->
                    
                    <div class="tabbable-panel">
                        <!-- Tabbablw-line Start -->
                        <div class="tabbable-line">
                            <!-- Nav Nav-tabs Start -->
                            <ul class="nav nav-tabs ">
                                <li class="active">
                                    <a href="#tab_default_1" data-toggle="tab">
                                        Popular Events </a>
                                </li>
                                <li>
                                    <a href="#tab_default_2" data-toggle="tab">
                                        Upcoming Events </a>
                                </li>
                            </ul>
                            <!-- //Nav Nav-tabs End -->
                            <!-- Tab-content Start -->
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_default_1">
                                    @if(count($popular))
                                    @foreach($popular as $event)
                                    <div class="media">
                                        <div class="media-left tab col-sm-6 col-md-12 col-xs-12">
                                            <a href="{{ URL::to('event/'.$event->slug) }}">
                                               @if($event->photo)
                                                    <img class="img-responsive img-hover" src="thumbnail2/{!! $event->photo !!}" alt="">
                                                    @else
                                                     <img src="{{ asset('assets/images/eventday/news1.jpg')}}" alt="">
                                                    @endif
                                            </a>
                                        </div>
                                    </div>
                                    <h4 class="text-primary">{{$event->name}}</h4>
                                    <p>
                                        {{ str_limit($event->description,100,'...')}} 
                                    </p>
                                    <div class="text-right primary marbtm"><a href="{{ URL::to('event/'.$event->slug) }}">Read more</a>
                                    </div>
                                    @endforeach
                                    @endif
                                    
                                </div>
                                <div class="tab-pane" id="tab_default_2">
                                    @if(count($upcoming))
                                    @foreach($upcoming as $event)
                                    <div class="media">
                                        <div class="media-left tab col-sm-6 col-md-12 col-xs-12">
                                            <a href="{{ URL::to('event/'.$event->slug) }}">
                                               @if($event->photo)
                                                    <img class="img-responsive img-hover" src="thumbnail2/{!! $event->photo !!}" alt="">
                                                    @else
                                                     <img src="{{ asset('assets/images/eventday/news1.jpg')}}" alt="">
                                                    @endif
                                            </a>
                                        </div>
                                    </div>
                                    <h4 class="text-primary">{{$event->name}}</h4>
                                    <p>
                                        {{ str_limit($event->description,100,'...')}} 
                                    </p>
                                    <div class="text-right primary marbtm"><a href="{{ URL::to('event/'.$event->slug) }}">Read more</a>
                                    </div>
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                            <!-- //Tab-content End -->
                        </div>
                        <!-- //Tabbablw-line End -->
                    </div>
                    <!-- Tabbable_panel End -->
                    
                </div>
                <!-- /.col-md-4 -->
            </div>
        </div>
    </div>
    
@stop

{{-- page level scripts --}}
@section('footer_scripts')

@stop
