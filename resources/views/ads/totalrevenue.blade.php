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
    <div class="row">
      <div class="col-sm-3"></div>
      <div class="col-sm-9">
        <div class="table-responsive">
        <table id="mytable" class="table table-bordred table-striped">
          <thead>
            <tr>
              <td>Total Earnings</td>
              <td>Withdrawls</td>
              <td>Expenses</td>
              <td>Pending Clearance</td>
              <td>Available Balance</td>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>${{$total_earnings}}</td>
              <td>${{$withdrawl_total}}</td>
              <td>${{$expenses}}</td>
              <td>${{$pending_clearence}}</td>
              <td>${{$available_balance}}</td>
            </tr>
          </tbody>
        </table>
        <a href="#" class="link withdraw" data-toggle="modal" data-target="#myModal">Withdraw amount</a>

      </div>
    </div>
  </div>
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
                          <h3><a href="{{url('details',$ad->slug)}}"> {{$ad->title}}</a></h3>
                            
                            <?php 
                              $price=0;
                            foreach($ad->booking as $book){
                                $price += $book->price;
                                
                            }
                            //echo "$".$price;
                            ?>
                             


                           <a href="{{ route('manage-ads',$ad) }}" class="manage">View Bookings</a>
                           <table class="table table-bordred">
                            <tr><th>Total Booking</th><th>Total Earning</th></tr>
                            <tr>
                              <td>{{ count($ad->booking) }}</td>
                              <td>{{$price}}</td>
                              
                              
                             
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
       
    </div>
    </div>
    </div>
    </div>
</section>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content load_modal">
          <div class="modal-header">
              <button type="button" class="close" 
                 data-dismiss="modal">
                     <span aria-hidden="true">&times;</span>
                     <span class="sr-only">Close</span>
              </button>
              <h4 class="modal-title" id="myModalLabel">
                  Withdrawl Request
              </h4>
          </div>
          <div class="modal-body">
                <form action="{{ url('withdrawrequest') }}" class="form-horizontal" role="form" method="post">
                {!! csrf_field() !!}
                  <div class="form-group">
                    <label  class="col-sm-2 control-label"
                              for="inputEmail3">Payment Type</label>
                    <div class="col-sm-10">
                        <select name="type" class="form-control">
                          <option value="paypal">Paypal</option>
                          <option value="banktransfer">Bank Transfer</option>
                        </select>

                        
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label"
                          for="inputPassword3" >Amount</label>
                    <div class="col-sm-10">
                        <input type="text" name="amount" class="form-control"
                            id="amount" placeholder="Amount"/>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-default">Submit</button>
                    </div>
                  </div>

                  </form>
                        
         </div>
         <div class="modal-footer">
              <!-- <button type="button" class="btn btn-default" data-dismiss="modal" id="modal_close">Close</button> -->

         </div>
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
