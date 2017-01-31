@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
exchange
@parent
@stop

@section('content')
<section class="content-header">
    <h1>Exchanges</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>exchanges</li>
        <li class="active">exchanges</li>
    </ol>
</section>

<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-heading clearfix">
                <h4 class="panel-title"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    exchange {{ $exchange->id }}'s details
                </h4>
            </div>
            <br />
            <div class="panel-body">
                <table class="table">
                    <tr><td>id</td><td>{{ $exchange->id }}</td></tr>
                     <tr><td>name</td><td>{{ $exchange['name'] }}</td></tr>
					<tr><td>rate</td><td>{{ $exchange['rate'] }}</td></tr>
					<tr><td>symbol</td><td>{{ $exchange['symbol'] }}</td></tr>
					
                </table>
            </div>
        </div>
    </div>
</div>
@stop