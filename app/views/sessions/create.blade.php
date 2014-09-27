@extends('layouts.master')

@section('content')

<div class="col-md-6 col-md-offset-3">
    <h1>Log in</h1>

    {{ Form::open(['route' => 'sessions.store']) }}
            <div class="form-group">
                {{ Form::label('email', 'email') }}
                {{ Form::text('email', null, ['class' => 'form-control']) }}
                {{ $errors->first('email') }}
            </div>

            <div class="form-group">
                {{ Form::label('password', 'password') }}
                {{ Form::password('password', ['class' => 'form-control']) }}
                {{ $errors->first('password') }}
            </div>

            <div class="form-group">
                {{ Form::submit('Login', ['class' => 'btn btn-primary']) }}
            </div>
        {{ Form::close() }}
</div>
@stop
