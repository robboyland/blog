@extends('layouts.master')

@section('content')
    <h1>Members</h1>
    @foreach($users as $user)
        <div>{{ $user->name }}</div>
    @endforeach
@stop
