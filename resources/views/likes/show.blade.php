@extends('layouts.app')

@section('title')
    {{ $track->name }} likes
@stop

@section('content')
    <div class="row">
        <div class="col-sm-12">
            @if (!$track->likes->isEmpty())
                @foreach ($track->likes as $like)
                    @include('followers.template', ['item' => $like])
                @endforeach
            @else
                <p>This track has no likes yet.</p>
            @endif
        </div>
    </div>
@stop