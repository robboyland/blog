@extends('layouts.master')

@section('content')
    <h1>Posts</h1>
    @foreach($posts as $post)
        <div>{{ $post->title }}</div>
    @endforeach
@stop
