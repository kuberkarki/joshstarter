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
       
      </div>
      
</div>
<div class="row">
    <div class="table-responsive">
        <table id="mytable" class="table table-bordred table-striped">
            <thead>
                
                <th>Ads</th>
                
            </thead>
            <tbody>
                 @forelse ($ads as $ad)
                <tr>
                    
                    <td>
                        <div class="row">
                          @if($ad->photo)
                            <div class="col-sm-3"><img src="{{ URL::to('thumbnail/'.$ad->photo)  }}" class="img-responsive" alt="Image"></div>
                        @else
                          <div class="col-sm-3"><img width="231" src="{{ asset('assets/images/eventday/adspic.jpg') }}" class="img-responsive"></div>
                        @endif
                          <div class="col-sm-3">
                            <ul class="ratingAds">
                            <li>{{$ad->title}}</li>
                             
                            </ul>
                           <a href="{{ route('manage-ads',$ad) }}" class="manage">Manage Booking</a>
                          </div>
                          <div class="col-sm-4">
                            {!!$calendar[$ad->id]!!}
                          </div>
                          <div class="col-sm-2">
                          <span style="display: inline-block;width:10px;height:20px;background-color:#00ff00;"></span>&nbsp;Booked<br/>
                            <span style="display: inline-block;width:10px;height:20px;background-color:#ff0000;"></span>&nbsp;Blocked<br/>
                            <span style="display: inline-block;width:10px;height:20px;background-color:none;"></span>&nbsp;Available
                            
                          
                          </div>
                        </div>
                    </td>
                    
                    <td>
                    <p data-placement="top" data-toggle="tooltip" title="Edit">
                   
                    <!-- <button class="btn btn-primary btn-xs" data-title="Edit" href="{!! route('edit-ads',$ad)!!}"  data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button> --></p>
                    </td>
                    
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

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content load_modal">
          <div class="modal-body">
          <em>Loading...</em>?
         </div>
         <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal" id="modal_close">Close</button>

         </div>
        </div>
    </div>
</div>

    
@stop



{{-- page level scripts --}}
@section('footer_scripts')
<script src="{{ asset('assets/js/eventday/stars.js') }}" type="text/javascript"></script>
<script>
 var base_url="{{route('booking-management')}}"+"/";

$(function() {
  
$('.openmodal').on('click', function(ev){

    var this_id = $(this).attr('data-id');
    var this_action = $(this).attr('data-action');

  
   
        $.get( base_url + this_id + '/load-' + this_action, function( data ) {
            $('#myModal').modal();
            $('#myModal').on('shown.bs.modal', function(){
                $('#myModal .load_modal').html(data);
            });
            $('#myModal').on('hidden.bs.modal', function(){
                $('#myModal .modal-body').data('');
            });
        });




    
});
  return $(".starrr").starrr();
});
$('#delete').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
});




/*$("#myModal").on("show.bs.modal", function(e) {
    var link = $(e.relatedTarget);
    $(this).find(".modal-body").load(link.attr("href"));
});*/
</script>
@stop
