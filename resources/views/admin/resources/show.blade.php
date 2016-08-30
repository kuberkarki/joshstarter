@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
resource
@parent
@stop

@section('content')
<section class="content-header">
    <h1>Resources</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>resources</li>
        <li class="active">resources</li>
    </ol>
</section>

<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-heading clearfix">
                <h4 class="panel-title"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    resource {{ $resource->id }}'s details
                </h4>
            </div>
            <br />
            <div class="panel-body">
                <table class="table">
                    <tr><td>id</td><td>{{ $resource->id }}</td></tr>
                     <tr><td>name</td><td>{{ $resource['name'] }}</td></tr>
					<tr><td>location</td><td>{{ $resource['location'] }}</td></tr>
					<tr><td>price_description</td><td>{{ $resource['price_description'] }}</td></tr>
					<tr><td>business_id</td><td>{{ $resource['business_id'] }}</td></tr>
					<tr><td>description</td><td>{{ $resource['description'] }}</td></tr>
					
                </table>
            </div>
        </div>
    </div>
</div>
@stop