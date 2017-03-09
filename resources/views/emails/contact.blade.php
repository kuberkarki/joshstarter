@extends('emails/layouts/default')

@section('content')
    <p>Hello ,</p>

    <p>We have received a new subscription mail.</p>

    <p>The provided details are:</p>

   

    <p>Email: {{ $data['contact-email'] }}</p>

   

@stop
