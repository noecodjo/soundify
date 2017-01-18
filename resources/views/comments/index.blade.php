@extends('layouts.app')

@section('title')
    {{ $user->username }} comments
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            @if (!$user->comments->isEmpty())
                @foreach ($user->comments as $comment)
                    <div class="media mt-1" style="border-bottom: 1px solid lightgray;">
                        <div class="media-body">
                            <p>
                                <small class="text-muted">on</small> <a href="/tracks/{{ $comment->track->id }}">{{ $comment->track->name }}</a>
                                <small class="text-muted float-xs-right">{{ $comment->created_at->diffForHumans() }}</small>
                            </p>
                            <p class="lead">"{{ $comment->body }}"</p>
                            @if ($auth->check() && $auth->id() == $user->id)
                                <form action="/tracks/{{ $comment->track->id }}/comments/{{ $comment->id }}" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-outline-secondary btn-sm mb-1">delete</button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            @else
                <p>This user has not posted a comment yet.</p>
            @endif
        </div>
    </div>
@stop