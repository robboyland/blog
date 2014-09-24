@extends('layouts.master')

@section('content')

    <h1>Update Post</h1>

    {{ Form::open(['route' => ['posts.update', $post->id], 'method' => 'put']) }}
            <div class="form-group">
                {{ Form::label('title', 'title') }}
                {{ Form::text('title', $post->title, ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                {{ Form::label('body', 'body') }}
                {{ Form::textarea('body', $post->body, ['class' => 'form-control']) }}
            </div>

                {{ Form::hidden('user_id', $post->user_id) }}

            <div class="form-group">
                {{ Form::submit('Update Post', ['class' => 'form-control']) }}
            </div>
        {{ Form::close() }}
@stop
