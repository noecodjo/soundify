<div class="row mb-2">
    <div class="col-sm-12">
        {{-- Auth homepage --}}
        @if (isset($userStream))
            <div class="row mb-1">
                <div class="col-sm-12">
                    <small>
                        <img src="{{ $track->user->avatarPath() }}" alt="{{ $track->user->username }}" width="20">
                        <a href="/users/{{ $track->user->username }}">
                            {{ $track->user->id == $auth->id() ? 'you' : $track->user->username }}
                        </a> posted
                        <a href="/tracks/{{ $track->id }}">a track</a>
                        {{ $track->created_at->diffForHumans() }}
                    </small>
                </div>
            </div>
        @else
            <small>{{ $track->created_at->diffForHumans() }}</small>
        @endif
        <div class="row">
            <div class="col-sm-2">
                <img src="{{ $track->avatarPath() }}" alt="{{ $track->name }}" class="img-fluid">
            </div>
            <div class="col-sm-10">
                <h6 class="text-muted" style="font-weight:400;">
                    <a href="/users/{{ $track_owner or $track->user->username }}">{{ $track_owner or $track->user->username }}</a>
                    <a class="tag tag-default float-xs-right" href="/tags/{{ $track->tag->name }}" style="font-weight:400;"># {{ $track->tag->name }}</a>
                </h6>
                <h6 style="font-weight:400;">
                    <a href="/tracks/{{ $track->id }}">{{ $track->name }}</a>
                </h6>
                <audio src="{{ $storage->url($track->path) }}" controls></audio>
                <form action="/tracks/{{ $track->id }}/likes" method="post">
                    {{ csrf_field() }}
                    <button type="submit" class="float-xs-left btn {{ (Auth::check() && $track->likedBy(Auth::user())) ? 'btn-warning' : 'btn-outline-secondary' }} btn-sm">{{ $track->likes->count() }} {{ $track->likes->count() == 1 ? 'like' : 'likes' }}</button>
                </form>
                <ul class="list-inline float-xs-right mb-0">
                    <li class="list-inline-item small">{{ $track->comments->count() }} {{ $track->comments->count() == 1 ? 'comment' : 'comments' }}</li>
                </ul>
            </div>
        </div>
    </div>
</div>