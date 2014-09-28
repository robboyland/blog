@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h1>{{ $post->title }}</h1>
            <div class="article-copy">{{ $post->body }}</div>
        </div>
    </div>
@stop
