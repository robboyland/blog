@extends('layouts.master')

@section('content')
    @foreach($posts as $post)
        <div>{{ $post->title }}</div>
    @endforeach
@stop
