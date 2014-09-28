@extends('layouts.master')

@section('content')
    @foreach($posts as $post)
        <div>{{ link_to_route('posts.show', $post->title, [$post->id]) }}
            <p>{{ $post->created_at->format('dS M y') }} | {{ $post->user->name }}</p>
        </div>
    @endforeach
@stop