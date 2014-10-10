@extends('layouts.master')

@section('content')
    <h1>{{ $category }}</h1>
    @foreach($posts as $post)
        <div>
            <a href="/{{$post->slug}}">{{$post->title}}</a>
            <p>{{ $post->created_at->format('dS M y') }} </p>
        </div>
    @endforeach
@stop
