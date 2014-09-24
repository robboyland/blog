@extends('layouts.master')

@section('content')
    <h1>{{ $post->title }}</h1>
    <div>{{ $post->body }}</div>
@stop
