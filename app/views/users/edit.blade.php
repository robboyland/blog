@extends('layouts.master')

@section('content')
<div class="col-md-8 col-md-offset-2">

    <h1>Update Details</h1>

    {{ Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'patch']) }}
            <div class="form-group">
                {{ Form::label('name', 'name') }}
                {{ Form::text('name', $user->name, ['class' => 'form-control']) }}
                {{ $errors->first('name') }}
            </div>

            <div class="form-group">
                {{ Form::label('email', 'email') }}
                {{ Form::text('email', $user->email, ['class' => 'form-control']) }}
                {{ $errors->first('email') }}
            </div>

            <div class="form-group">
                {{ Form::label('notify', 'Email notifications when new articles published') }}
                {{ Form::checkbox('notify', null, null,  ['id' => 'notify']) }}
            </div>

            <div class="form-group">
                {{ Form::submit('Update Details', ['class' => 'btn btn-primary']) }}
            </div>
        {{ Form::close() }}
</div>
@stop
