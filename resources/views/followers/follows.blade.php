@extends('layouts.app')

@section('title')
    {{ $user->username }} follows
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            @if (!$user->follows->isEmpty())
                <div class="row">
                    @foreach ($user->follows as $followee)
                        @include('followers.template', ['item' => $followee])
                    @endforeach
                </div>
            @else
                <p>This user follows no one yet.</p>
            @endif
        </div>
    </div>
@stop