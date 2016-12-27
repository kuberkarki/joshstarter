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
      <div class="col-sm-12"><h3>Total Revenue</h3></div>
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
                          <div class="col-sm-9">
                            <ul class="ratingAds">
                            <li>{{$ad->title}}</li>
                            <li>Total bookings: {{ count($ad->booking) }}</li>
                            <li>Total Amount:
                            <?php 
                              $price=0;
                            foreach($ad->booking as $book){
                                $price += $book->price;
                                
                            }
                            echo $price;
                            ?>
                             </li>
                             
                            </ul>


                           <a href="{{ route('manage-ads',$ad) }}" class="manage">View Bookings</a>
                           <table class="table table-bordred">
                            <tr><th>Total Earn</th><th>Withdrawls</th><th>Use to Order</th><th>Pending Clearance</th><th>Available Balance</th></tr>
                            <tr>
                              <td>{{$price}}</td>
                              <td>0</td>
                              <td>0</td>
                              <td>{{$price}}</td>
                              <td>{{$price}}</td>
                              
                             
                            </tr>
                           </table>

                            <table class="table table-bordred">
                            <tr><th>Withdraw</th><th>Paypal</th><th>Banktransfer</th></tr>
                            <tr>
                              <td>{{$price}}</td>
                              <td>0</td>
                              <td>0</td>
                            </tr>
                           </table>
                          </div>
                        </div>
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
