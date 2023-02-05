@extends('base')

@section('content')
    <h1>Bonjour {{$customer->customer->login}}</h1>
@endsection