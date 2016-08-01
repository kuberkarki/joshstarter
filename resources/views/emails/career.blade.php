@extends('emails/layouts/default')

@section('content')
    <p>Hello ,</p>

    <p>We have received a new career mail.</p>

    <p>The provided details are:</p>

    <p>Name: {{ $data['name'] }}</p>

    <p>Expertised: {{ $data['expertised'] }}</p>

    <p>Location: {{ $data['location'] }}</p>

    <p>Email: {{ $data['email'] }}</p>

    <p>Message: {{ $data['message'] }}  </p>

@stop
