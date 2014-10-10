@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-sm-8 blog-main">
            <h1>posts</h1>
            @foreach($posts as $post)
                <div>
                    <a href="/{{$post->slug}}">{{$post->title}}</a>
                    <p>{{ $post->created_at->format('dS M y') }} | {{ $post->user->name }}</p>
                </div>
            @endforeach
        </div>
        <div class="col-sm-3 col-sm-offset-1 blog-sidebar">
            <h2>categories</h2>
            @foreach($categories as $category)
                <div>{{ link_to('/category/' . $category->id . '/posts', $category->name) }}</div>
            @endforeach
            <h2>tags</h2>
            @foreach($tags as $tag)
                <div>{{ link_to('/tag/' . $tag->id . '/posts', $tag->name) }}</div>
            @endforeach
        </div>
    </div>
@stop