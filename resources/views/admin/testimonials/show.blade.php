@extends('admin/layouts/default')

{{-- Page title --}}
@section('title')
testimonial
@parent
@stop

@section('content')
<section class="content-header">
    <h1>Testimonials</h1>
    <ol class="breadcrumb">
        <li>
            <a href="{{ route('dashboard') }}"> <i class="livicon" data-name="home" data-size="16" data-color="#000"></i>
                Dashboard
            </a>
        </li>
        <li>testimonials</li>
        <li class="active">testimonials</li>
    </ol>
</section>

<section class="content paddingleft_right15">
    <div class="row">
        <div class="panel panel-primary ">
            <div class="panel-heading clearfix">
                <h4 class="panel-title"> <i class="livicon" data-name="list-ul" data-size="16" data-loop="true" data-c="#fff" data-hc="white"></i>
                    testimonial {{ $testimonial->id }}'s details
                </h4>
            </div>
            <br />
            <div class="panel-body">
                <table class="table">
                    <tr><td>id</td><td>{{ $testimonial->id }}</td></tr>
                     <tr><td>name</td><td>{{ $testimonial['name'] }}</td></tr>
					<tr><td>title</td><td>{{ $testimonial['title'] }}</td></tr>
					<tr><td>company</td><td>{{ $testimonial['company'] }}</td></tr>
					<tr><td>description</td><td>{{ $testimonial['description'] }}</td></tr>
					
                </table>
            </div>
        </div>
    </div>
</div>
@stop