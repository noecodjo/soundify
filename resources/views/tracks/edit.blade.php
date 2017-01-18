@extends('layouts.app')

@section('title', 'Edit Track')

@section('content')
    @include('flash_message')
    <div class="row">
        <div class="col-sm-12">
            <a href="/tracks/{{ $track->id }}">View track</a>
            <hr>
        </div>
        <div class="col-sm-12">
            <h4>General</h4>
            <form action="/tracks/{{ $track->id }}" method="post">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="form-group row {{ $errors->has('name') ? 'has-danger' : '' }}">
                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input id="name" type="text" name="name" value="{{ old('name', $track->name) }}" class="form-control">
                        @if ($errors->has('name'))
                            <div class="form-control-feedback">
                                {{ $errors->first('name') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-group row {{ $errors->has('tag') ? 'has-danger' : '' }}">
                    <label for="tag" class="col-sm-2 col-form-label">Tag</label>
                    <div class="col-sm-10">
                        <input id="tag" type="text" name="tag" value="{{ old('tag', $track->tag->name) }}" class="form-control">
                        @if ($errors->has('tag'))
                            <div class="form-control-feedback">
                                {{ $errors->first('tag') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="description" class="col-sm-2 col-form-label">Description <small class="text-muted">(optional)</small></label>
                    <div class="col-sm-10">
                        <textarea name="description" id="description" rows="10" class="form-control" value="{{ old('description', $track->description) }}">{{ old('description', $track->description) }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10 offset-sm-2">
                        <button type="submit" class="btn btn-outline-danger">Update</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-sm-12 mt-2">
            <h4>Avatar</h4>
            <img src="{{ $track->avatarPath() }}" alt="{{ $track->name }} thumbnail" width="125" height="125">
            <form action="/tracks/{{ $track->id }}/avatar" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="form-group row {{ $errors->has('avatar') ? 'has-danger' : '' }}">
                    <label for="avatar" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input id="avatar" type="file" name="avatar">
                        @if ($errors->has('avatar'))
                            <div class="form-control-feedback">
                                {{ $errors->first('avatar') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10 offset-sm-2">
                        <button type="submit" class="btn btn-outline-danger">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop