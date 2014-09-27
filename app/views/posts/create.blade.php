@extends('layouts.master')

@section('content')
<div class="col-md-8 col-md-offset-2">

    <h1>Create Post</h1>

    {{ Form::open(['route' => 'posts.store']) }}
            <div class="form-group">
                {{ Form::label('title', 'title') }}
                {{ Form::text('title', null, ['class' => 'form-control']) }}
                {{ $errors->first('title') }}
            </div>

            <div class="form-group">
                {{ Form::label('body', 'body') }}
                {{ Form::textarea('body', null, ['class' => 'form-control']) }}
                {{ $errors->first('body') }}
            </div>

            <div class="form-group">
                {{ Form::label('categories', 'categories') }}
                {{ Form::select('category_id', $categories, ['class' => 'form-control']) }}
                {{ $errors->first('categories') }}
            </div>

                {{ Form::hidden('user_id', 1) }}

            <div class="form-group">
                {{ Form::submit('Create Post', ['class' => 'btn btn-primary']) }}
            </div>
        {{ Form::close() }}
</div>
@stop
