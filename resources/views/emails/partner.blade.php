@extends('emails/layouts/default')

@section('content')
    <p>Hello ,</p>

    <p>We have received a new Partner mail.</p>

    <p>The provided details are:</p>

    <p>Name: {{ $data['name'] }}</p>

    <p>Company: {{ $data['company'] }}</p>


    <p>Email: {{ $data['email'] }}</p>

    <p>Message: {{ $data['message'] }}  </p>

@stop