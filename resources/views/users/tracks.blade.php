@extends('layouts.app')

@section('title', 'Your Tracks')

@section('content')
    @include('flash_message')
    <div class="row">
        <div class="col-sm-12">
            @if (!$tracks->isEmpty())
                <table class="table table-hover">
                    <tr>
                        <th>Name</th>
                        <th>Likes</th>
                        <th>Comments</th>
                        <th>Added</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    @foreach ($tracks as $track)
                        <tr>
                            <td>{{ $track->name }}</td>
                            <td>{{ $track->likes()->count() }}</td>
                            <td>{{ $track->comments()->count() }}</td>
                            <td>{{ $track->created_at->format('j. F Y') }}</td>
                            <td><a href="/tracks/{{ $track->id }}">View</a></td>
                            <td><a href="/tracks/{{ $track->id }}/edit">Edit</a></td>
                            <td><a href="/tracks/{{ $track->id }}/delete">Delete</a></td>
                        </tr>
                    @endforeach
                </table>
            @else
                <p>Looks like you have no tracks yet.</p>
            @endif
        </div>
    </div>
@stop