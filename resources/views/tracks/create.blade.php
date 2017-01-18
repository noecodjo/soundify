@extends('layouts.app')

@section('title', 'New Track')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <form action="/tracks" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group row {{ $errors->has('track') ? 'has-danger' : '' }}">
                    <label for="track" class="col-sm-2 col-form-label">Choose track</label>
                    <div class="col-sm-10">
                        <input id="track" type="file" name="track">
                        @if ($errors->has('track'))
                            <div class="form-control-feedback">
                                {{ $errors->first('track') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-group row {{ $errors->has('name') ? 'has-danger' : '' }}">
                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input id="name" type="text" name="name" value="{{ old('name') }}" class="form-control">
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
                        <input id="tag" type="text" name="tag" value="{{ old('tag') }}" class="form-control">
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
                        <textarea name="description" id="description" rows="10" class="form-control" value="{{ old('description') }}">{{ old('description') }}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10 offset-sm-2">
                        <button type="submit" class="btn btn-outline-danger">Upload</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@stop