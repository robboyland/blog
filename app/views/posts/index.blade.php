@extends('layouts.master')

@section('content')
    <div>{{ link_to_route('posts.create', 'Add new post') }}</div>

    <h1>Posts</h1>
    @foreach($posts as $post)
        <div>{{ $post->title }}</div>
    @endforeach
@stop
