@extends('layouts.app')

@section('title', 'Search')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            @if ($query)
                @if (!$tracks->isEmpty())
                    <p class="mb-2">Found {{ $tracks->count() }} {{ $tracks->count() == 1 ? 'track' : 'tracks' }} matching '{{ $query }}'</p>
                    @foreach ($tracks as $track)
                        @include('tracks.template')
                    @endforeach
                @else
                    <p>Found 0 tracks matching '{{ $query }}'</p>
                @endif
            @else
                <form method="get" action="/search">
                    <div class="form-group">
                        <label for="search">Search Soundify for tracks..</label>
                        <input id="search" class="form-control" type="text" name="query" autofocus>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-danger" type="submit">Search</button>
                    </div>
                </form>
            @endif
        </div>
    </div>
@stop