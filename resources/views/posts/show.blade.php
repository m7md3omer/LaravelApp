@extends('layouts.app')
@section('content')
    <a href="/posts" class="btn btn-outline-info">Go back</a>
    <h1>{{ $post->title }}</h1>
    <p>{!! $post->body !!}</p>
    <hr>
    <small>written on {{ $post->created_at }}</small>
    <hr>
    <a href="/posts/{{ $post->id }}/edit" class="btn btn-info">Edit</a>
@endsection