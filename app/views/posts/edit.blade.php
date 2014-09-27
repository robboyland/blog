@extends('layouts.master')

@section('content')
<div class="col-md-8 col-md-offset-2">

    <h1>Update Post</h1>

    {{ Form::open(['route' => ['posts.update', $post->id], 'method' => 'put']) }}
            <div class="form-group">
                {{ Form::label('title', 'title') }}
                {{ Form::text('title', $post->title, ['class' => 'form-control']) }}
                {{ $errors->first('title') }}
            </div>

            <div class="form-group">
                {{ Form::label('body', 'body') }}
                {{ Form::textarea('body', $post->body, ['class' => 'form-control']) }}
                {{ $errors->first('body') }}
            </div>

            <div class="form-group">
                {{ Form::label('categories', 'categories') }}
                {{ Form::select('category_id', $categories , $post->category_id) }}
                {{ $errors->first('categories_id') }}
            </div>
                {{ Form::hidden('user_id', $post->user_id) }}

            <div class="form-group">
                {{ Form::submit('Update Post', ['class' => 'btn btn-primary']) }}
            </div>
        {{ Form::close() }}
</div>
@stop
