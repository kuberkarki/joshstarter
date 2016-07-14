@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
Editable Datatables
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/select2/css/select2.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/select2/css/select2-bootstrap.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/dataTables.bootstrap.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/buttons.bootstrap.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/colReorder.bootstrap.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/dataTables.bootstrap.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/rowReorder.bootstrap.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/buttons.bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/scroller.bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/pages/tables.css') }}" />
@stop

{{-- Page content --}}
@section('content')

<section class="content-header">
                <h1>Editable Datatables</h1>
                <ol class="breadcrumb">
                    <li>
                        <a href="{{ route('dashboard') }}">
                            <i class="livicon" data-name="home" data-size="14" data-loop="true"></i>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="#">DataTables</a>
                    </li>
                    <li class="active">Editable Datatables</li>
                </ol>
            </section>
            <!-- Main content -->
            <section class="content">
                <!-- Second Data Table -->
                <div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                        <div class="panel panel-danger table-edit">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    <span>
                                    <i class="livicon" data-name="edit" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                                    Editable Table</span>
                                    <span class="table-toolbar pull-right">
                                        <div class="btn-group">
                                            <button id="sample_editable_1_new" class=" btn btn-custom btn-default">
                                                Add New
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </span>
                                </h3>
                            </div>
                            <div class="panel-body">
                                <div id="sample_editable_1_wrapper" class="">
                                    <table class="table table-striped table-bordered table-hover dataTable no-footer" id="sample_editable_1" role="grid">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting_asc" tabindex="0" aria-controls="sample_editable_1" rowspan="1" colspan="1">Username</th>
                                                <th class="sorting" tabindex="0" aria-controls="sample_editable_1" rowspan="1" colspan="1" aria-label="
                                                 Full Name
                                            : activate to sort column ascending" style="width: 222px;">Full Name</th>
                                                <th class="sorting" tabindex="0" aria-controls="sample_editable_1" rowspan="1" colspan="1" aria-label="
                                                 Points
                                            : activate to sort column ascending" style="width: 124px;">Points</th>
                                                <th class="sorting" tabindex="0" aria-controls="sample_editable_1" rowspan="1" colspan="1" aria-label="
                                                 Notes
                                            : activate to sort column ascending" style="width: 152px;">Notes</th>
                                                <th class="sorting" tabindex="0" aria-controls="sample_editable_1" rowspan="1" colspan="1" aria-label="
                                                 Edit
                                            : activate to sort column ascending" style="width: 88px;">Edit</th>
                                                <th class="sorting" tabindex="0" aria-controls="sample_editable_1" rowspan="1" colspan="1" aria-label="
                                                 Delete
                                            : activate to sort column ascending" style="width: 125px;">Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr role="row" class="odd">
                                                <td class="sorting_1">Tatyana</td>
                                                <td>Tatyana Nilson</td>
                                                <td>1234</td>
                                                <td class="center">power user</td>
                                                <td>
                                                    <a class="edit" href="javascript:;">Edit</a>
                                                </td>
                                                <td>
                                                    <a class="delete" href="javascript:;">Delete</a>
                                                </td>
                                            </tr>
                                            <tr role="row" class="even">
                                                <td class="sorting_1">Martena</td>
                                                <td>Martena Mccray</td>
                                                <td>62</td>
                                                <td class="center">new user</td>
                                                <td>
                                                    <a class="edit" href="javascript:;">Edit</a>
                                                </td>
                                                <td>
                                                    <a class="delete" href="javascript:;">Delete</a>
                                                </td>
                                            </tr>
                                            <tr role="row" class="odd">
                                                <td class="sorting_1">Cedric</td>
                                                <td>Cedric Kelly</td>
                                                <td>132</td>
                                                <td class="center">elite user</td>
                                                <td>
                                                    <a class="edit" href="javascript:;">Edit</a>
                                                </td>
                                                <td>
                                                    <a class="delete" href="javascript:;">Delete</a>
                                                </td>
                                            </tr>
                                            <tr role="row" class="even">
                                                <td class="sorting_1">Sonya</td>
                                                <td>Sonya Wong</td>
                                                <td>434</td>
                                                <td class="center">new user</td>
                                                <td>
                                                    <a class="edit" href="javascript:;">Edit</a>
                                                </td>
                                                <td>
                                                    <a class="delete" href="javascript:;">Delete</a>
                                                </td>
                                            </tr>
                                            <tr role="row" class="odd">
                                                <td class="sorting_1">Gavin</td>
                                                <td>Gavin Joyce</td>
                                                <td>232</td>
                                                <td class="center">power user</td>
                                                <td>
                                                    <a class="edit" href="javascript:;">Edit</a>
                                                </td>
                                                <td>
                                                    <a class="delete" href="javascript:;">Delete</a>
                                                </td>
                                            </tr>
                                            <tr role="row" class="even">
                                                <td class="sorting_1">Timothy</td>
                                                <td>Antonio Sanches</td>
                                                <td>462</td>
                                                <td class="center">new user</td>
                                                <td>
                                                    <a class="edit" href="javascript:;">Edit</a>
                                                </td>
                                                <td>
                                                    <a class="delete" href="javascript:;">Delete</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- END EXAMPLE TABLE PORTLET-->
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- content -->
        
    @stop

{{-- page level scripts --}}
@section('footer_scripts')

    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/jquery.dataTables.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.bootstrap.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.buttons.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.colReorder.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.responsive.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.rowReorder.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/buttons.colVis.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/buttons.html5.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/buttons.print.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/buttons.bootstrap.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/buttons.print.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/pdfmake.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/vfs_fonts.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.scroller.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/select2/js/select2.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/js/pages/table-editable.js') }}" ></script>
@stop
