@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="row">
        @if ($auth->check())
            <div class="col-sm-9">
                @foreach ($tracks as $track)
                    @include('tracks.template', ['userStream' => true])
                @endforeach
            </div>
            <div class="col-sm-3">
                <div class="row">
                    <div class="col-sm-12">
                        <h6>{{ $user->likes->count() }} {{ $user->likes->count() == 1 ? 'like' : 'likes' }}
                            @if ($user->likes->count() > 3)
                                <a href="/users/{{ $user->username }}/likes" class="float-xs-right">View all</a>
                            @endif
                        </h6>
                    </div>
                    <div class="col-sm-12">
                        <ul class="list-group">
                            @foreach ($user->likes->reverse()->take(3) as $track)
                                <li class="list-group-item">
                                    <h6 class="list-group-item-heading text-muted"><a href="/users/{{ $track->user->username }}">{{ $track->user->username }}</a></h6>
                                    <small class="list-group-item-text"><a href="/tracks/{{ $track->id }}">{{ $track->name }}</a></small>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @else
            <div class="col-sm-12">
                @if (!$tracks->isEmpty())
                    <p class="lead">Latest tracks..</p>
                    @foreach ($tracks as $track)
                        @include('tracks.template')
                    @endforeach
                @else
                    <h6>There are no tracks yet.</h6>
                @endif
            </div>
        @endif
    </div>
@stop