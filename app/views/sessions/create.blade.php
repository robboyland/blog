@extends('layouts.master')

@section('content')
    {{ Form::open(['route' => 'sessions.store']) }}
            <div class="form-group">
                {{ Form::label('email', 'email') }}
                {{ Form::text('email', null, ['class' => 'form-control']) }}
            </div>

            <div class="form-group">
                {{ Form::label('password', 'password') }}
                {{ Form::password('password', ['class' => 'form-control']) }}

            </div>

            <div class="form-group">
                {{ Form::submit('Login', ['class' => 'form-control']) }}
            </div>
        {{ Form::close() }}
@stop
