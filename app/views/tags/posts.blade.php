@extends('layouts.master')

@section('content')
    <h1>tag name here</h1>
    @foreach($posts as $post)
        <div>{{ link_to_route('posts.show', $post->title, [$post->id]) }}
            <p>{{ $post->created_at->format('dS M y') }} </p>
        </div>
    @endforeach
@stop
