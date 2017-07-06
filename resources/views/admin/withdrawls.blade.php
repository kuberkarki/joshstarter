@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Withdrawl Request
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')

    <link href="{{ asset('assets/vendors/fullcalendar/css/fullcalendar.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/css/pages/calendar_custom.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" media="all" href="{{ asset('assets/vendors/bower-jvectormap/css/jquery-jvectormap-1.2.2.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/vendors/animate/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/only_dashboard.css') }}"/>
    <meta name="_token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('assets/vendors/datetimepicker/css/bootstrap-datetimepicker.min.css') }}">

@stop

{{-- Page content --}}
@section('content')

    <section class="content-header">
        <h1>Withdrawl</h1>
        <ol class="breadcrumb">
            <li class="active">
                <a href="#">
                    <i class="livicon" data-name="home" data-size="16" data-color="#333" data-hovercolor="#333"></i>
                    Withdrawl Requests
                </a>
            </li>
        </ol>
    </section>
 
        
        
        
        <section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-heading clearfix">
                <h4 class="panel-title pull-left"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    Withdrawls
                </h4>
                
            </div>
            <br />
            <div class="panel-body">
                <table class="table table-bordered " id="table">
                    <thead>
                        <tr class="filters">
                            <th>ID</th>
                            <th>Type</th>
                            <th>Amt</th>
                            <th>Date</th>
                            <th>user</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($withdrawls as $withdrawl)
                        <tr>
                            <td>{!! $withdrawl->id !!}</td>
                            <td>{!! $withdrawl->description !!}</td>
                            <td>${!! $withdrawl->amount !!}</td>
                            <td>{!! $withdrawl->date !!}</td>
                            
                            <td>
                            <a href="{{url('admin/users',$withdrawl->user->id)}}">{!! $withdrawl->user->email.' ('.$withdrawl->user->first_name.' '.$withdrawl->user->last_name.')' !!}</a></td>
                            <td>
                            <a class="approve" href="#" data-toggle="modal" data-target="#withdrawlapprove" data-id="{{$withdrawl->id}}">Aprove</a>
                             <a class="disapprove" data-toggle="modal" data-target="#withdrawldisapprove" href="#" data-id="{{$withdrawl->id}}">Disaprove</a>
                                
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>    <!-- row-->

       
    </section>

    <div class="modal fade" id="withdrawlapprove" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content load_modal">
          <div class="modal-header">
              <button type="button" class="close" 
                 data-dismiss="modal">
                     <span aria-hidden="true">&times;</span>
                     <span class="sr-only">Close</span>
              </button>
              <h4 class="modal-title" id="myModalLabel">
                  Withdrawl Approve
              </h4>
          </div>
          <div class="modal-body">
                <form action="{{ url('admin/approvewithdrawl') }}" class="form-horizontal" role="form" method="post">
                {!! csrf_field() !!}
                <input type="hidden" name="id" id="id" value="">
                  <div class="form-group">
                    <label  class="col-sm-2 control-label"
                              for="inputEmail3">Comment</label>
                    <div class="col-sm-10">
                        <textarea name="comment" class="form-control"></textarea>

                        
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-success">Approve</button>
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

<div class="modal fade" id="withdrawldisapprove" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content load_modal">
          <div class="modal-header">
              <button type="button" class="close" 
                 data-dismiss="modal">
                     <span aria-hidden="true">&times;</span>
                     <span class="sr-only">Close</span>
              </button>
              <h4 class="modal-title" id="myModalLabel">
                  Withdrawl Disapprove
              </h4>
          </div>
          <div class="modal-body">
                <form action="{{ url('admin/disapprovewithdrawl') }}" class="form-horizontal" role="form" method="post">
                {!! csrf_field() !!}
                <input type="hidden" name="id" id="id" value="">
                  <div class="form-group">
                    <label  class="col-sm-2 control-label"
                              for="inputEmail3">Comment</label>
                    <div class="col-sm-10">
                        <textarea name="comment" class="form-control"></textarea>

                        
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-default btn-danger">Dispprove</button>
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
<script>
$(document).on("click", ".approve", function () {
     var myId = $(this).data('id');
     $(".modal-body #id").val( myId );
     // As pointed out in comments, 
     // it is superfluous to have to manually call the modal.
     // $('#addBookDialog').modal('show');
});

$(document).on("click", ".disapprove", function () {
     var myId = $(this).data('id');
     $(".modal-body #id").val( myId );
     // As pointed out in comments, 
     // it is superfluous to have to manually call the modal.
     // $('#addBookDialog').modal('show');
});
</script> 




@stop
