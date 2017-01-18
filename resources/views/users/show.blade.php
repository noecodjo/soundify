@extends('layouts.app')

@section('title')
    {{ $user->username }}
@stop

@section('content')
    @if ($auth->check() && $auth->id() == $user->id)
        <div class="row">
            <div class="col-sm-3 offset-sm-9">
                <a href="/users/edit" class="btn btn-outline-secondary btn-block mb-1">Edit Profile</a>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-sm-9">
            @foreach ($user->tracks as $track)
                @include('tracks.template', ['track_owner' => $user->username])
            @endforeach
        </div>
        <div class="col-sm-3">
            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-md-4">
                            <a href="/users/{{ $user->username }}/followers">
                                <small>Followers</small>
                                <h6>{{ $user->followers->count() }}</h6>
                            </a>
                        </div>
                            <div class="col-md-4">
                                <a href="/users/{{ $user->username }}/following">
                                    <small>Following</small>
                                    <h6>{{ $user->follows()->count() }}</h6>
                                </a>
                            </div>
                        <div class="col-md-4">
                            <small>Tracks</small>
                            <h6>{{ $user->tracks->count() }}</h6>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <hr>
                <div class="col-sm-12">
                    <img class="img-fluid" src="{{ $user->avatarPath() }}" alt="{{ $user->username }}'s picture">
                </div>
            </div>

            @if (!$auth->check() || $auth->id() != $user->id)
                <hr>
                <div class="row">
                    <div class="col-sm-12">
                        <form action="/users/{{ $user->username }}/followers" method="post">
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-outline-secondary btn-block">
                                @if ($auth->guest())
                                    Follow
                                @else
                                    {{ $user->followedBy($auth->user()) ? 'Unfollow' : 'Follow' }}
                                @endif
                            </button>
                        </form>
                    </div>
                </div>
            @endif

            <hr>
            <div class="row">
                <div class="col-sm-12">
                    <a href="/users/{{ $user->username }}/likes">
                        <h6>{{ $user->likes->count() }} {{ $user->likes->count() == 1 ? 'like' : 'likes' }}
                            @if ($user->likes->count() > 3)
                                <span" class="float-xs-right">View all</span>
                            @endif
                        </h6>
                    </a>
                    <hr>
                </div>
                <div class="col-sm-12">
                    <ul class="list-group">
                        @foreach ($user->likes->sortByDesc('created_at')->take(3) as $track)
                            <li class="list-group-item">
                                <h6 class="list-group-item-heading text-muted"><a href="/users/{{ $track->user->username }}">{{ $track->user->username }}</a></h6>
                                <small class="list-group-item-text"><a href="/tracks/{{ $track->id }}">{{ $track->name }}</a></small>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <hr>
            <div class="row">
                <div class="col-sm-12">
                    <a href="/users/{{ $user->username }}/following">
                        <h6>{{ $user->follows->count() }} following
                            @if ($user->follows->count() > 3)
                                <span class="float-xs-right">View all</span>
                            @endif
                        </h6>
                    </a>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <ul class="list-group">
                        @foreach ($user->follows->sortByDesc('created_at')->take(3) as $followee)
                            <li class="list-group-item">
                                <h6 class="list-group-item-heading text-muted"><a href="/users/{{ $followee->username }}">{{ $followee->username }}</a></h6>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <hr>
            <div class="row">
                <div class="col-sm-12">
                    <a href="/users/{{ $user->username }}/comments">
                        <h6>{{ $user->comments->count() }} {{ $user->comments->count() == 1 ? 'comment' : 'comments' }}
                            @if ($user->comments->count() > 3)
                                <span class="float-xs-right">View all</span>
                            @endif
                        </h6>
                    </a>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <ul class="list-group">
                        @foreach ($user->comments->sortByDesc('created_at')->take(3) as $comment)
                            <li class="list-group-item">
                                <small class="help-block text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                <p class="list-group-item-text mt-1">
                                    <small>on</small>
                                    <span class="text-muted">
                                        <a href="/tracks/{{ $comment->track->id }}">{{ $comment->track->name }}</a>
                                    </span>
                                </p>
                                <small class="list-group-item-text">"{{ strlen($comment->body) > 100 ? substr($comment->body, 0, 100) . '..' : $comment->body }}"</small>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@stop