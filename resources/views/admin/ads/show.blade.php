@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
ad
@parent
@stop

@section('content')
<section class="content-header">
    <h1>Ads</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>ads</li>
        <li class="active">ads</li>
    </ol>
</section>

<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-heading clearfix">
                <h4 class="panel-title"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    ad {{ $ad->id }}'s details
                </h4>
            </div>
            <br />
            <div class="panel-body">
                <table class="table">
                    <tr><td>id</td><td>{{ $ad->id }}</td></tr>
                     <tr><td>title</td><td>{{ $ad['title'] }}</td></tr>
					<tr><td>location</td><td>{{ $ad['location'] }}</td></tr>
					<tr><td>description</td><td>{{ $ad['description'] }}</td></tr>
					<tr><td>photo</td><td>{{ $ad['photo'] }}</td></tr>
					<tr><td>video</td><td>{{ $ad['video'] }}</td></tr>
					<tr><td>available_date</td><td>{{ $ad['available_date'] }}</td></tr>
					<tr><td>price</td><td>{{ $ad['price'] }}</td></tr>
					<tr><td>additional_package_offer</td><td>{{ $ad['additional_package_offer'] }}</td></tr>
					<tr><td>additional_ads_title</td><td>{{ $ad['additional_ads_title'] }}</td></tr>
					<tr><td>price_type</td><td>{{ $ad['price_type'] }}</td></tr>
					<tr><td>publish</td><td>{{ $ad['publish'] }}</td></tr>
					
                </table>
            </div>
        </div>
    </div>
</div>
@stop