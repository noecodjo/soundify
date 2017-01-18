@extends('layouts.app')

@section('title', 'View Track')

@section('content')
    <div class="row pt-1 pb-1" style="background-color: #ccc;">
        <div class="col-md-2 push-md-10">
            <img src="{{ $track->avatarPath() }}" alt="{{ $track->name }}" class="img-fluid">
        </div>
        <div class="col-md-10 pull-md-2">
            <h4 class="text-muted">
                <a href="/users/{{ $track->user->username }}" style="font-weight:300;">{{ $track->user->username }}</a>
                <span class="float-xs-right small" style="font-weight:300;">{{ $track->created_at->diffForHumans() }}</span>
            </h4>
            <h4 style="font-weight:300;">
                {{ $track->name }}
                <a class="tag tag-default float-xs-right" href="/tags/{{ $track->tag->name }}" style="font-weight:300;"># {{ $track->tag->name }}</a>
            </h4>
            <audio src="{{ $storage->url($track->path) }}" controls class="mt-2"></audio>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-md-10">
            <form action="/tracks/{{ $track->id }}/likes" method="post">
                {{ csrf_field() }}
                <button type="submit" class="btn {{ ($auth->check() && $track->likedBy($auth->user())) ? 'btn-warning' : 'btn-outline-secondary' }} btn-sm float-xs-left">{{ ($auth->check() && $track->likedBy($auth->user())) ? 'Liked' : 'Like' }}</button>
            </form>
            <span class="text-muted float-xs-right">
                <a href="/tracks/{{ $track->id }}/likes">{{ $track->likes->count() }} {{ $track->likes->count() == 1 ? 'like' : 'likes' }}</a>
            </span>
        </div>
    </div>

    <hr>

    <div class="row">
        <div class="col-md-2">
            <div class="row">
                <div class="col-sm-12">
                    <a href="/users/{{ $track->user->username }}">
                        <img width="64" height="64" class="media-object" src="{{ $track->user->avatarPath() }}" alt="{{ $track->user->username }}'s picture">
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 mt-1">
                    <h6 class="text-muted"><a href="/users/{{ $track->user->username }}">{{ $track->user->username }}</a></h6>
                </div>
            </div>
        </div>
        <div class="col-md-10">
            <div class="row">
                <div class="col-sm-12">
                    <p class="lead">
                        @if ($track->description)
                            {!! nl2br(e($track->description)) !!}
                        @else
                            No description.
                        @endif
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <hr>
                    <form action="/tracks/{{ $track->id }}/comments" method="post">
                        {{ csrf_field() }}
                        <div class="form-group {{ $errors->has('body') ? 'has-danger' : '' }}">
                            <label for="body">Leave a comment</label>
                            <textarea class="form-control" id="body" rows="3" name="body"></textarea>
                            @if ($errors->has('body'))
                                <div class="form-control-feedback">
                                    {{ $errors->first('body') }}
                                </div>
                            @endif
                        </div>
                        <div class="form group">
                            <button type="submit" class="btn btn-outline-secondary">Send</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 mt-1">
                    <small class="text-muted">{{ $track->comments->count() }} {{ $track->comments->count() == 1 ? 'comment' : 'comments'}}</small>
                </div>
            </div>
            <div class="row mt-2">
                @foreach ($track->comments->sortByDesc('created_at') as $comment)
                    <div class="col-sm-12">
                        <div class="media mb-2">
                            <a class="media-left" href="/users/{{ $comment->user->username }}">
                                <img width="32" height="32" class="media-object" src="{{ $comment->user->avatarPath() }}" alt="{{ $comment->user->username }}'s picture">
                            </a>
                            <div class="media-body">
                                <h6 class="media-heading">
                                    <a href="/users/{{ $comment->user->username }}">{{ $comment->user->username }}</a>
                                    <small class="text-muted float-xs-right">{{ $comment->created_at->diffForHumans() }}</small>
                                </h6>
                                <p>{{ $comment->body }}</p>
                                @if ($auth->check() && $auth->id() == $comment->user->id)
                                    <form action="/tracks/{{ $comment->track->id }}/comments/{{ $comment->id }}" method="post">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-outline-secondary btn-sm">delete</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@stop