@extends('layouts.app')

@section('title')
    #{{ $tag->name }}
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            @if (!$tag->tracks->isEmpty())
                <h6 class="mb-1">Most popular tracks for #{{ $tag->name }}</h6>
                @foreach ($tag->tracks as $track)
                    @include('tracks.template')
                @endforeach
            @else
                <h6>No tracks found for {{ $tag->name }}</h6>
            @endif
        </div>
    </div>
@stop