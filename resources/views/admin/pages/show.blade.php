@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
page
@parent
@stop

@section('content')
<section class="content-header">
    <h1>Pages</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>pages</li>
        <li class="active">pages</li>
    </ol>
</section>

<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-heading clearfix">
                <h4 class="panel-title"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    page {{ $page->id }}'s details
                </h4>
            </div>
            <br />
            <div class="panel-body">
                <table class="table">
                    <tr><td>id</td><td>{{ $page->id }}</td></tr>
                     <tr><td>name</td><td>{{ $page['name'] }}</td></tr>
					<tr><td>slug</td><td>{{ $page['slug'] }}</td></tr>
					<tr><td>content</td><td>{{ $page['content'] }}</td></tr>
					<tr><td>type</td><td>{{ $page['type'] }}</td></tr>
					
                </table>
            </div>
        </div>
    </div>
</div>
@stop