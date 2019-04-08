@extends('layouts.app')
@section('content')
<div class="jumbotron text-center">
    <h1>Welcome to laravel!</h1>
    <p>This is my first laravel application</p>
    <a class="btn btn-primary btn-lg" href="{{ route('login') }}" role="button">Login</a>
    <a class="btn btn-success btn-lg" href="{{ route('register') }}" role="button">Register</a>
</div>
@endsection
