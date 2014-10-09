@extends('layouts.master')

@section('content')
<div class="col-md-8 col-md-offset-2">
    {{ Form::open(['route' => 'tags.store']) }}
            <div class="form-group">
                {{ Form::label('name', 'name') }}
                {{ Form::text('name', null, ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                {{ Form::submit('Create Tag', ['class' => 'btn btn-primary']) }}
            </div>
        {{ Form::close() }}
</div>
@stop
