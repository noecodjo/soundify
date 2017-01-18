@extends('layouts.app')

@section('title', 'Delete Track')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-block">
                <h4 class="card-title text-danger">Warning</h4>
                <p class="card-text">Are you sure you want to delete <em><a href="/tracks/{{ $track->id }}">{{ $track->name }}</a></em>?</p>
                <form action="/tracks/{{ $track->id }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <button type="submit" class="btn btn-danger">Delete</button>
                    <a href="{{ URL::previous() }}" class="btn btn-secondary">Back</a>
                </form>
            </div>
        </div>
    </div>
@stop