@extends('layouts/eventday')

{{-- Page title --}}
@section('title')
My Ads
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <!--page level css starts-->
    <!--end of page level css-->
@stop




{{-- Page content --}}
@section('content')
<section class="mainContainer">
<div class="contantWrapper innercontantWrapper adsListing">
  <div class="container">

  <div class="row">
      <div class="col-sm-12"><h3>My Ads Listing</h3></div>
      @include('business.usermenu')
     
      <div class="col-sm-9">
        @include('notifications')
        <ul class="adsNav-list">
          <li><a href="#">Active</a></li> 
          <li><a href="#">Pending Approval</a></li> 
          <li><a href="#">Require Modification</a></li> 
          <li><a href="#">Draft</a></li> 
          <li><a href="#">Denied</a></li>
        </ul>
      </div>
      <div class="col-sm-3">
        <a href="{{route('create-ads')}}" class="btn btn-primary pull-right">create New Ads</a>
      </div>
</div>
<div class="row">
    <div class="table-responsive">
        <table id="mytable" class="table table-bordred table-striped">
            <thead>
                <th><input type="checkbox" id="checkall" /></th>
                <th>Active Ads</th>
                <th>Impression</th>
                <th>Click</th>
                <th>Views</th>
                <th>Book/Hire</th>
                <th>Cancellation</th>
                <th>Edit</th>
                <th>Delete</th>
            </thead>
            <tbody>
                 @forelse ($ads as $ad)
                <tr>
                    <td><input type="checkbox" class="checkthis" /></td>
                    <td>
                        <div class="row">
                          @if($ad->photo)
                             <div class="col-sm-6"><img src="{{ URL::to('thumbnail/'.$ad->photo)  }}" class="img-responsive" alt="Image"></div>
                        @else
                        <div class="col-sm-6"><img width="231" src="{{ asset('assets/images/eventday/adspic.jpg') }}" class="img-responsive"></div>
                            @endif
                          <div class="col-sm-6">
                            <ul class="ratingAds">
                            <li>{{$ad->title}}</li>
                              <li>
                               <div class="rating">
                               
                               @for($i=0; $i < ((int)$ad->averagerating);$i++)
                               
                               <i class="fa fa-star" aria-hidden="true"></i>
                              
                               @endfor
                                @if(count($ad->ratings)==0)
                                    No ratings Yet
                                @endif
                              
                               </div>
                              <!-- <div data="{!! $ad->id !!}" id="stars" class="stars starrr rating" data-rating='{!! (int)$ad->averagerating !!}' data-logged="{{Sentinel::check()?true:false}}"></div> -->
                              <span class="review">({!! count($ad->ratings) !!})</span></li>
                            </ul>
                           <a href="{{ route('manage-ads',$ad) }}" class="manage">Manage Booking</a>
                          </div>
                        </div>
                    </td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>0</td>
                    <td>
                    <p data-placement="top" data-toggle="tooltip" title="Edit">
                    <a class="btn btn-primary btn-xs" data-title="Edit" href="{!! route('edit-ads',$ad)!!}" ><span class="glyphicon glyphicon-pencil"></span></a>
                    <!-- <button class="btn btn-primary btn-xs" data-title="Edit" href="{!! route('edit-ads',$ad)!!}"  data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button> --></p>
                    </td>
                    <td><p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-href="{!! route('delete-ads',$ad)!!}" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p></td>
                </tr>
                @empty
                    <h3>No Ads Exists!</h3>
                @endforelse

            </tbody>
        </table>
        <div class="clearfix"></div>
        @include('pagination.limit_links', ['paginator' => $ads])
    </div>
    </div>
    </div>
    </div>
</section>

<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Edit Your Detail</h4>
      </div>
          <div class="modal-body">
          <div class="form-group">
        <input class="form-control " type="text" placeholder="test">
        </div>
        <div class="form-group">
        
        <input class="form-control " type="text" placeholder="test">
        </div>
        <div class="form-group">
        <textarea rows="2" class="form-control" placeholder="test"></textarea>
    
        
        </div>
      </div>
          <div class="modal-footer ">
        <button type="button" class="btn btn-warning btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> Update</button>
      </div>
        </div>
    <!-- /.modal-content --> 
  </div>
      <!-- /.modal-dialog --> 
    </div>
    
    
    
    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Delete this entry</h4>
      </div>
          <div class="modal-body">
       
       <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Are you sure you want to delete this Ads?</div>
       
      </div>
        <div class="modal-footer ">
        <a class="btn btn-danger btn-ok"><span class="glyphicon glyphicon-ok-sign"></span>Yes</a>
        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
      </div>
        </div>
    <!-- /.modal-content --> 
  </div>
      <!-- /.modal-dialog --> 
    </div>
@stop

@section('content_old')

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
<script src="{{ asset('assets/js/eventday/stars.js') }}" type="text/javascript"></script>
<script>
$(function() {
  return $(".starrr").starrr();
});
$('#delete').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
});
</script>
@stop
