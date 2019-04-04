@extends('layouts.app')
@section('content')
    <h1 class="well">Posts</h1>
    @if (count($posts) > 0)
        @foreach ($posts as $post)
            <div class="card card-body bg-light">
                <h3><a href="/posts/{{ $post->id }}">{{ $post->title }}</a></h3>
                <small>written on {{ $post->created_at }}</small>
                <p>{!!$post->body!!}</p>
            </div>
            @endforeach
            {{ $posts->onEachSide(3)->links() }}
    @else
        <h2>No posts found</h2>
    @endif
@endsection