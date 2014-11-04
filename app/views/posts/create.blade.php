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
                {{ Form::label('slug', 'slug') }}
                {{ Form::text('slug', null, ['class' => 'form-control']) }}
                {{ $errors->first('slug') }}
            </div>

            <div class="form-group">
                {{ Form::label('body', 'body') }}
                {{ Form::textarea('body', null, ['class' => 'form-control']) }}
                {{ $errors->first('body') }}
            </div>

            <div class="form-group">
                {{ Form::label('categories', 'categories') }}
                {{ Form::select('category_id', array('default' => 'Please select one option') + $categories, 'default', ['class' => 'form-control']) }}
                {{ $errors->first('category_id') }}
            </div>

            <div class="form-group">
                <h2>tags</h2>

                @foreach ($tags as $tag)
                    <div><label>
                    <input type="checkbox" name="tags[]" id="{{ $tag->id }}" value="{{ $tag->id }}">
                    {{ $tag->name }}</label></div>
                @endforeach
            </div>

                {{ Form::hidden('user_id', Auth::user()->id) }}

            <div class="form-group">
                {{ Form::submit('Create Post', ['class' => 'btn btn-primary']) }}
            </div>
        {{ Form::close() }}
</div>
@stop
