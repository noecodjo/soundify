@extends('layouts.app')

@section('title')
    {{ $user->username }} followers
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            @if (!$user->followers->isEmpty())
                <div class="row">
                    @foreach ($user->followers as $follower)
                        @include('followers.template', ['item' => $follower])
                    @endforeach
                </div>
            @else
                <p>This user has no followers yet.</p>
            @endif
        </div>
    </div>
@stop