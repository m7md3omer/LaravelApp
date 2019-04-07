@extends('layouts.app')
@section('content')
    <a href="/posts" class="btn btn-outline-info">Go back</a>
    <h1>{{ $post->title }}</h1>
    <img style="width:100%" src="/storage/cover_images/{{ $post->cover_image }}" alt="{{ $post->cover_image }}">
    <br><br>
    <p>{!! $post->body !!}</p>
    <hr>
    <small>written on {{ $post->created_at }} by {{$post->user->name}}</small>
    <hr>
    @if (Auth()->user()->id == $post->user_id)
        <a href="/posts/{{ $post->id }}/edit" class="btn btn-info">Edit</a>
        {!! Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'style' => 'float:right;']) !!}
            {{ Form::hidden('_method', 'DELETE') }}
            {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
        {!! Form::close() !!} 
        
    @endif
@endsection