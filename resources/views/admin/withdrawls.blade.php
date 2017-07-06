@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    Dashboard
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
        <h1>Welcome to Admin</h1>
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
                            <th>Amount</th>
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
                            <td>{!! $withdrawl->amount !!}</td>
                            <td>{!! $withdrawl->date !!}</td>
                            
                            <td>
                            <a href="{{url('admin/users',$withdrawl->user->id)}}">{!! $withdrawl->user->email.' ('.$withdrawl->user->first_name.' '.$withdrawl->user->last_name.')' !!}</a></td>
                            <td>
                                
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>    <!-- row-->

       
    </section>

@stop

{{-- page level scripts --}}
@section('footer_scripts')
   




@stop
