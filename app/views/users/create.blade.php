@extends('layouts.master')

@section('content')
<div class="col-md-8 col-md-offset-2">

    <h1>Sign up</h1>
    {{ Form::open(['route' => 'users.store']) }}
            <div class="form-group">
                {{ Form::label('name', 'name') }}
                {{ Form::text('name', null, ['class' => 'form-control']) }}
                {{ $errors->first('name') }}
            </div>

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
                {{ Form::label('password_confirmation', 'confirm password') }}
                {{ Form::password('password_confirmation', ['class' => 'form-control']) }}
                {{ $errors->first('password_confirmation') }}
            </div>

            <div class="form-group">
                {{ Form::submit('Sign up', ['class' => 'btn btn-primary']) }}
            </div>
           {{ Form::close() }}
</div>
@stop
