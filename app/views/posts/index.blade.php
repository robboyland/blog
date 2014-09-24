@extends('layouts.master')

@section('content')
    <div>{{ link_to_route('posts.create', 'Add new post') }}</div>

    <h1>Posts</h1>
    @foreach($posts as $post)
        <div>{{ link_to_route('posts.show', $post->title, [$post->id]) }}</div>
        <div>{{ link_to_route('posts.edit', 'edit', [$post->id]) }}</div>
    @endforeach
@stop
