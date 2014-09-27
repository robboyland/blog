@extends('layouts.master')

@section('content')
    @foreach($posts as $post)
        <div>{{ link_to_route('posts.show', $post->title, [$post->id]) }}</div>
    @endforeach
@stop