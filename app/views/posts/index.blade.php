@extends('layouts.master')

@section('content')

    @if (Session::has('flash_message'))
        <div class="alert alert-info">{{ Session::get('flash_message') }}</div>
    @endif

    <div>{{ link_to_route('series.create', 'Create new series') }}</div>
    <div>{{ link_to_route('posts.create', 'Create new post') }}</div>

    <h1>Series</h1>
    @foreach($series as $series)
        <div>{{ link_to_route('series.index', $series->title, [$series->id]) }}</div>
    @endforeach

    <h1>Posts</h1>
    @foreach($posts as $post)
        <div>{{ link_to_route('posts.show', $post->title, [$post->id]) }}</div>
        <div>{{ link_to_route('posts.edit', 'edit', [$post->id]) }}
            {{ Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'delete']) }}
                {{ Form::submit('Delete', ['class' => 'btn btn-default btn-sm']) }}
            {{ Form::close() }}
        </div>

    @endforeach
@stop
