@extends('layouts.master')

@section('content')
    <h1>Series</h1>
    @foreach($series as $series)
        <div>{{ link_to_route('series.show', $series->title, [$series->id]) }}</div>
    @endforeach
@stop
