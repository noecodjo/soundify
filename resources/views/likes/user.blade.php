@extends('layouts.app')

@section('title')
    {{ $user->username }} likes
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            @if (!$tracks->isEmpty())
                @foreach ($tracks as $track)
                    @include('tracks.template')
                @endforeach
            @else
                <p>This user has no likes yet.</p>
            @endif
        </div>
    </div>
@stop