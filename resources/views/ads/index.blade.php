@extends('layouts/eventday')

{{-- Page title --}}
@section('title')
My Ads
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <!--page level css starts-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/tabbular.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/frontend/blog.css') }}">
    <!--end of page level css-->
@stop




{{-- Page content --}}
@section('content')
    <!-- Container Section Strat -->
    <div class="container textsmall">
        <h2>My Ads</h2>
         @include('notifications')
        <div class="row">

        @include('business.usermenu')
         <ul class="nav navbar-nav navbar-left">
                            
                            <li><a href="{{route('create-ads')}}">Create Ads</a></li>
                        </ul>
            <div class="content">
                <div class="col-md-8">
                    @forelse ($ads as $ad)
                    <!-- BEGIN FEATURED POST -->

                     <div class=" thumbnail featured-post-wide img">
                    @if($ad->photo)
                        <img src="{{ URL::to('/uploads/crudfiles/'.$ad->photo)  }}" class="img-responsive" alt="Image">
                    @endif
                     @if(count($ad->photos()))
                        <div class="row">
                        <ul class="thumbnails">
                          @foreach($ad->photos()->get() as $photo)
                            <li class="img-{{$photo->id}}"> 
                           
    
                            <img src="{{ URL::to('/uploads/crudfiles/'.$photo->photo)  }}" alt="..."
                                                     class="img-responsive" width="100px" />
                            
                           
                            </li>
                          @endforeach
                          </ul>
                          

                        @endif
                        </div>
                    <!-- /.event-detail-image -->
                    <div class="the-box no-border event-detail-content">
                    <h2>{{$ad->title}}</h2>
    

                        <p class="additional-post-wrap">
                            <span>
                            <i class="fa fa-level-up" aria-hidden="true"></i> {!! $ads_category[$ad->ads_category_id] !!}
                            </span>
                            <span class="additional-post">
                              <div class="address"><i class="fa fa-map-marker" aria-hidden="true"></i> {!! $ad->location !!}</div>     
                            </span>

                            
                        </p>
                        <p class="text-justify">
                            {!! $ad->description !!}
                        </p>
                        <p class="pull-right">
                        
                        <a href="{!! route('edit-ads',$ad)!!}"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a> | 
                        <a href="{!! route('delete-ads',$ad)!!}"><i class="fa fa-close" aria-hidden="true"></i> Delete</a>
                        </p>
                       
                    </div>
                    </div>
               
                    
                    <!-- /.featured-post-wide -->
                    <!-- END FEATURED POST -->
                    @empty
                        <h3>No Ads Exists!</h3>
                    @endforelse
                    
                </div>
                <!-- /.col-md-8 -->
                <div class="col-md-4">
                    <!-- END POPULAR POST -->
                    <!-- Tabbable-Panel Start -->
                    <h3 class="martop">TAB WIDGET</h3>
                    <div class="tabbable-panel">
                        <!-- Tabbablw-line Start -->
                        <div class="tabbable-line">
                            <!-- Nav Nav-tabs Start -->
                            <ul class="nav nav-tabs ">
                                <li class="active">
                                    <a href="#tab_default_1" data-toggle="tab">
                                        Popular Posts </a>
                                </li>
                                <li>
                                    <a href="#tab_default_2" data-toggle="tab">
                                        Recent Posts </a>
                                </li>
                            </ul>
                            <!-- //Nav Nav-tabs End -->
                            <!-- Tab-content Start -->
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_default_1">
                                    <div class="media">
                                        <div class="media-left tab col-sm-6 col-md-12 col-xs-12">
                                            <a href="#">
                                                <img class="media-object img-responsive" src="{{ asset('assets/images/img_3.jpg') }}" alt="image">
                                            </a>
                                        </div>
                                    </div>
                                    <h4 class="text-primary">Jelly-o sesame snaps</h4>
                                    <p>
                                        Extraordinary claims require extraordinary evidence globular star cluster great turbulent clouds dispassionate extraterrestrial observer hearts of the stars. Jean-François Champollion Euclid the sky. 
                                    </p>
                                    <div class="text-right primary marbtm"><a href="#">Read more</a>
                                    </div>
                                    <div class="media">
                                        <div class="media-left tab col-sm-6 col-md-12 col-xs-12">
                                            <a href="#">
                                                <img class="media-object img-responsive" src="{{ asset('assets/images/img_5.jpg') }}" alt="image">
                                            </a>
                                        </div>
                                    </div>
                                    <h4 class="text-primary">Fishing cayenne bisque cayenne</h4>
                                    <p>
                                        The Love Boat soon will be making another run. The Love Boat promises something for everyone. On the most sensational inspirational celebrational Muppetational. This is what we call the Muppet Show.
                                    </p>
                                    <div class="text-right primary"><a href="#">Read more</a>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab_default_2">
                                    <div class="media">
                                        <div class="media-left media-middle tab col-sm-12 col-xs-12">
                                            <a href="#">
                                                <img class="media-object img-responsive" src="{{ asset('assets/images/img_5.jpg') }}" alt="image">
                                            </a>
                                        </div>
                                    </div>
                                    <h4 class="text-primary">Come along, Pond. Allons-y</h4>
                                    <p>
                                        Zombie ipsum reversus ab viral inferno, nam rick grimes malum cerebro. De carne lumbering animata corpora quaeritis. Summus brains sit​​, morbo vel maleficia? De apocalypsi gorger omero undead survivor dictum mauris.
                                    </p>
                                    <div class="text-right primary marbtm"><a href="#">Read more</a>
                                    </div>
                                    <div class="media">
                                        <div class="media-left tab col-sm-6 col-md-12 col-xs-12">
                                            <a href="#">
                                                <img class="media-object img-responsive" src="{{ asset('assets/images/img_3.jpg') }}" alt="image">
                                            </a>
                                        </div>
                                    </div>
                                    <h4 class="text-primary">Jelly-o sesame snaps</h4>
                                    <p>
                                        Hi mindless mortuis soulless creaturas, imo evil stalking monstra adventus resi dentevil vultus comedat cerebella viventium. Qui animated corpse, cricket bat max brucks terribilem incessu zomby.
                                    </p>
                                    <div class="text-right primary"><a href="#">Read more</a>
                                    </div>
                                </div>
                            </div>
                            <!-- //Tab-content End -->
                        </div>
                        <!-- //Tabbablw-line End -->
                    </div>
                    <!-- Tabbable_panel End -->
                    <div class="the-box recent">
                        <h3 class="small-heading text-center">RECENT COMMENTS</h3>
                        <ul class="media-list media-xs media-dotted">
                            <li class="media">
                                <a class="pull-left" href="#">
                                    <img src="{{ asset('assets/images/authors/avatar.jpg') }}" class="img-circle img-responsive pull-left" alt="riot">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading primary">
                                                        <a href="#">Elizabeth Owens at Duis autem vel eum iriure dolor in hendrerit in</a>
                                                    </h4>
                                    <p class="date">
                                        <small class="text-danger">2hours ago</small>
                                    </p>
                                    <p class="small">
                                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo
                                    </p>
                                </div>
                            </li>
                            <hr>
                            <li class="media">
                                <a class="pull-left" href="#">
                                    <img src="{{ asset('assets/images/authors/avatar1.jpg') }}" class="img-circle img-responsive pull-left" alt="riot">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading primary">
                                                        <a href="#">Harold Chavez at Duis autem vel eum iriure dolor in hendrerit in</a>
                                                    </h4>
                                    <p class="date">
                                        <small class="text-danger">5hours ago</small>
                                    </p>
                                    <p class="small">
                                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo
                                    </p>
                                </div>
                            </li>
                            <hr>
                            <li class="media">
                                <a class="pull-left" href="#">
                                    <img src="{{ asset('assets/images/authors/avatar5.jpg') }}" class="img-circle img-responsive pull-left" alt="riot">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading primary">
                                                        <a href="#">Mihaela Cihac at Duis autem vel eum iriure dolor in hendrerit in</a>
                                                    </h4>
                                    <p class="date">
                                        <small class="text-danger">10hours ago</small>
                                    </p>
                                    <p class="small">
                                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo
                                    </p>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="thumbnail">
                        
                    </div>
                </div>
                <!-- /.col-md-4 -->
            </div>
        </div>
    </div>
    
@stop

{{-- page level scripts --}}
@section('footer_scripts')

@stop
