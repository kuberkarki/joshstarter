@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    @lang('news/title.newslist')
@parent
@stop

{{-- page level styles --}}
@section('header_styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/dataTables.bootstrap.css') }}" />
    <link href="{{ asset('assets/css/pages/tables.css') }}" rel="stylesheet" type="text/css" />
@stop


{{-- Page content --}}
@section('content')
<section class="content-header">
    <h1>@lang('news/title.newss')</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                @lang('general.dashboard')
            </a>
        </li>
        <li>@lang('news/title.news')</li>
        <li class="active">@lang('news/title.newss')</li>
    </ol>
</section>

<!-- Main content -->
<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-heading clearfix">
                <h4 class="panel-title pull-left"> <i class="livicon" data-name="users" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    @lang('news/title.newslist')
                </h4>
                <div class="pull-right">
                    <a href="{{ URL::to('admin/news/create') }}" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-plus"></span> @lang('button.create')</a>
                </div>
            </div>
            <br />
            <div class="panel-body">
                <table class="table table-bordered" id="table">
                    <thead>
                        <tr class="filters">
                            <th>@lang('news/table.id')</th>
                            <th>@lang('news/table.title')</th>
                            <th>@lang('news/table.comments')</th>
                            <th>@lang('news/table.created_at')</th>
                            <th>Is Top News</th>
                            <th>@lang('news/table.actions')</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if(!empty($newss))
                        @foreach ($newss as $news)
                            <tr>
                                <td>{{ $news->id }}</td>
                                <td>{{ $news->title }}</td>
                                <td>{{ $news->comments->count() }}</td>
                                <td>{{ $news->created_at->diffForHumans() }}</td>
                                <td>@if($news->isTopNews)
                            <a href="{{ route('admin.news.cancelTop', $news->id) }}" >
                                    <i class="livicon" data-name="star-full" data-size="18" data-loop="true" data-c="#01BC8C" data-hc="#f56954" title="Top News"></i>
                                </a>
                            @endif
                            @if(!$news->isTopNews)
                            <a href="{{ route('admin.news.makeTop', $news->id) }}" >
                                    <i class="livicon" data-name="star-full" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#000" title="Top News"></i>
                                </a>
                            @endif</td>
                                <td>
                                    <a href="{{ URL::to('admin/news/' . $news->id . '/show' ) }}"><i class="livicon"
                                                                                                     data-name="info"
                                                                                                     data-size="18"
                                                                                                     data-loop="true"
                                                                                                     data-c="#428BCA"
                                                                                                     data-hc="#428BCA"
                                                                                                     title="@lang('news/table.view-news-comment')"></i></a>
                                    <a href="{{ URL::to('admin/news/' . $news->id . '/edit' ) }}"><i class="livicon"
                                                                                                     data-name="edit"
                                                                                                     data-size="18"
                                                                                                     data-loop="true"
                                                                                                     data-c="#428BCA"
                                                                                                     data-hc="#428BCA"
                                                                                                     title="@lang('news/table.update-news')"></i></a>
                                    <a href="{{ route('confirm-delete/news', $news->id) }}" data-toggle="modal"
                                       data-target="#delete_confirm"><i class="livicon" data-name="remove-alt"
                                                                        data-size="18" data-loop="true" data-c="#f56954"
                                                                        data-hc="#f56954"
                                                                        title="@lang('news/table.delete-news')"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>    <!-- row-->
</section>
@stop

{{-- page level scripts --}}
@section('footer_scripts')
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/jquery.dataTables.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.bootstrap.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#table').DataTable();
        });
    </script>

<div class="modal fade" id="delete_confirm" tabindex="-1" role="dialog" aria-labelledby="user_delete_confirm_title" aria-hidden="true">
	<div class="modal-dialog">
    	<div class="modal-content"></div>
  </div>
</div>
<script>
$(function () {
	$('body').on('hidden.bs.modal', '.modal', function () {
		$(this).removeData('bs.modal');
	});
});
</script>
@stop