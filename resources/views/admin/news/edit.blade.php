@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
    @lang('news/title.edit')
@parent
@stop

{{-- page level styles --}}
@section('header_styles')

    <link href="{{ asset('assets/vendors/summernote/dist/summernote.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/vendors/summernote/dist/summernote-bs3.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/vendors/select2/select2.min.css') }}" type="text/css" />
    <link href="{{ asset('assets/vendors/tags/dist/bootstrap-tagsinput.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/pages/news.css') }}" rel="stylesheet" type="text/css">

    <!--end of page level css-->
@stop


{{-- Page content --}}
@section('content')
<section class="content-header">
    <!--section starts-->
    <h1>@lang('news/title.add-news')</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="14" data-c="#000" data-loop="true"></i>
                @lang('general.home')
            </a>
        </li>
        <li>
            <a href="#">@lang('news/title.news')</a>
        </li>
        <li class="active">@lang('news/title.add-news')</li>
    </ol>
</section>
<!--section ends-->
<section class="content paddingleft_right15">
    <!--main content-->
    <div class="row">
        <div class="the-box no-border">
           {!! Form::model($news, array('url' => URL::to('admin/news/' . $news->id.'/edit'), 'method' => 'post', 'class' => 'bf', 'files'=> true)) !!}
                <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group">
                            {!! Form::text('title', null, array('class' => 'form-control input-lg', 'required' => 'required', 'placeholder'=>trans('news/form.ph-title'))) !!}
                        </div>
                        <div class='box-body pad'>
                            {!! Form::textarea('content', null, array('class' => 'textarea form-control','rows'=>'5','placeholder'=>trans('news/form.ph-content'), 'style'=>'style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"')) !!}
                        </div>
                    </div>
                    <!-- /.col-sm-8 -->
                    <div class="col-sm-4">
                        <div class="form-group">
                            {!! Form::label('news_category_id', trans('news/form.ll-postcategory')) !!}
                            {!! Form::select('news_category_id',$newscategory ,null, array('class' => 'form-control select2', 'placeholder'=>trans('news/form.select-category')))!!}
                        </div>
                        <div class="form-group">
                            {!! Form::text('tags', $news->tagList, array('class' => 'form-control input-lg', 'data-role'=>"tagsinput", 'placeholder'=>trans('news/form.tags')))!!}
                        </div>
                        <div class="form-group">
                            <label>@lang('news/form.lb-featured-img')</label>
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <span class="btn btn-primary btn-file">
                                    <span class="fileupload-new">@lang('news/form.select-file')</span>
                                    <span class="fileupload-exists">@lang('news/form.change')</span>
                                     {!! Form::file('image', null, array('class' => 'form-control')) !!}
                                </span>
                                @if(!empty($news->image))
                                    <span class="fileupload-preview">
                                        <img src="{{URL::to('uploads/news/'.$news->image)}}" class="img-responsive" alt="Image">
                                    </span>
                                @endif
                                <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">@lang('news/form.publish')</button>
                            <a href="{{ URL::to('admin/news') }}" class="btn btn-danger">@lang('news/form.discard')</a>
                        </div>
                    </div>
                    <!-- /.col-sm-4 --> </div>
                <!-- /.row -->
                {!! Form::close() !!}
        </div>
    </div>
    <!--main content ends-->
</section>
@stop
{{-- page level scripts --}}
@section('footer_scripts')
    <script type="text/javascript" src="{{ asset('assets/vendors/summernote/dist/summernote.min.js') }}" ></script>
    <script src="{{ asset('assets/vendors/select2/select2.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/vendors/tags/dist/bootstrap-tagsinput.js') }}" ></script>
    <script type="text/javascript" src="{{ asset('assets/js/pages/add_newnews.js') }}" ></script>
@stop