@extends('layouts.master')

@section('content')
    <div class="col-md-8 col-md-offset-2">
    <h1>Create Series</h1>
    {{ Form::open(['route' => 'series.store']) }}
            <div class="form-group">
                {{ Form::label('title', 'title') }}
                {{ Form::text('title', null, ['class' => 'form-control']) }}
            </div>

            {{ Form::hidden('user_id', Auth::user()->id) }}

            <div class="form-group">
                {{ Form::submit('Create Series', ['class' => 'btn btn-primary']) }}
            </div>
        {{ Form::close() }}
    </div>
@stop
