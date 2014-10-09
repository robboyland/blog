@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h1>{{ $post->title }}</h1>
            <div class="article-copy">{{ $post->body }}</div>
        </div>
    </div>

    <div id="row">
        <div class="col-md-8 col-md-offset-2" id="post-comments">
            @if ( ! Auth::guest())
                {{ Form::open(['route' => 'comments.store'])}}
                    {{ Form::hidden('post_id', $post->id) }}
                    {{ Form::hidden('user_id', Auth::user()->id) }}
                    <div class="form-group">
                        {{ Form::label('body', 'Comment:') }}
                        {{ Form::textarea('body', null, ['class' => 'form-control']) }}
                        {{ $errors->first('body') }}
                    </div>
                    <div class="form-group">
                        {{ Form::submit('Create Post', ['class' => 'btn btn-primary']) }}
                    </div>
                {{ Form::close() }}
            @endif

            @if (isset($comments))
                <h2>Comments &nbsp;<span class="comment-count">{{ count($comments)}}</span></h2>
                @foreach($comments as $comment)
                    <section class="comments">
                        <div class="comment-details">{{ $comment->created_at->format('Y m d') }} &middot; {{ $comment->user->name }}</div>
                        <p>{{ $comment->body }}</p>
                    </section>
                @endforeach
            @endif
        </div>
    </div>
@stop
