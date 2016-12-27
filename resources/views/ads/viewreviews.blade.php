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
      <div class="col-sm-12"><h3>Reviews</h3></div>
      @include('business.usermenu')
     
      <div class="col-sm-9">
        @include('notifications')
       
      </div>
      
</div>
<div class="row">
    <div class="table-responsive">
        <div class="headingCustomerPara">Reviews( {!! count($ad->reviews()->get()) !!} )</div>
              <ul class="media-list">
                    @foreach($ad->reviews()->get() as $review)
                        <div class="row">
                            <div class="col-md-12">
                           
                            

                            {{-- */$reviewer=App\user::find($review->author_id);/* --}}
                            
                                    Buyer: {!! $reviewer->first_name?$reviewer->first_name:$reviewer->name  ." ".$reviewer->last_name !!} 
                                    <span class="pull-right">
                                    {!! $review->updated_at->diffForHumans() !!}
                                    </span> 
                              <p>Rating: 
                              @for($i=1;$i<=5;$i++)
                                @if($review->rating>=$i)
                                    <span class="glyphicon glyphicon-star"></span>
                                @else
                                    <span class="glyphicon glyphicon-star-empty"></span>
                                @endif
                            @endfor
                            </p>
                            <p>Ads Name: {{$ad->title}}</p>
                             <p>Review Title: {!! $review->title !!}</p>
                            <p>Review: {!! $review->body !!}</p>
                          </div>
                       </div>
                    
                    <div class="col-xs-12 hrspacing"><hr class="hrcolor"></div>
                    @endforeach
              </ul>
        <div class="clearfix"></div>
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
