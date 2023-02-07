@extends('base')

@section('content')
    <h1>Bonjour <b>{{$customer->firstName}}</b> {{$customer->lastName}}</h1>
@endsection