@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
ads_category
@parent
@stop

@section('content')
<section class="content-header">
    <h1>Ads_categories</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>ads_categories</li>
        <li class="active">ads_categories</li>
    </ol>
</section>

<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-heading clearfix">
                <h4 class="panel-title"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    ads_category {{ $ads_category->id }}'s details
                </h4>
            </div>
            <br />
            <div class="panel-body">
                <table class="table">
                    <tr><td>id</td><td>{{ $ads_category->id }}</td></tr>
                     <tr><td>name</td><td>{{ $ads_category['name'] }}</td></tr>
					<tr><td>homepage</td><td>{{ $ads_category['homepage'] }}</td></tr>
					
                </table>
            </div>
        </div>
    </div>
</div>
@stop