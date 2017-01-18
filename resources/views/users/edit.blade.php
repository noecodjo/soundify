@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            @include('flash_message')
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-block">
                        <h4 class="card-title">General</h4>
                        <form method="POST" action="/users/{{ $user->username}}">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <div class="form-group row {{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label for="name" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}">
                                    @if ($errors->has('name'))
                                        <div class="form-control-feedback">
                                            {{ $errors->first('name') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row {{ $errors->has('username') ? ' has-danger' : '' }}">
                                <label for="username" class="col-sm-2 col-form-label">Username</label>
                                <div class="col-sm-10">
                                    <input id="username" type="text" class="form-control" name="username" value="{{ old('username', $user->username) }}">
                                    @if ($errors->has('username'))
                                        <div class="form-control-feedback">
                                            {{ $errors->first('username') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row {{ $errors->has('email') ? ' has-danger' : '' }}">
                                <label for="email" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}">
                                    @if ($errors->has('email'))
                                        <div class="form-control-feedback">
                                            {{ $errors->first('email') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                    <button type="submit" class="btn btn-danger">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card card-block">
                        <h4 class="card-title">Change Password</h4>
                        <form method="POST" action="/users/{{ $user->username}}/password">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <div class="form-group row {{ $errors->has('password_old') ? ' has-danger' : '' }}">
                                <label for="password_old" class="col-sm-2 col-form-label">Current</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="password_old" name="password_old">
                                    @if ($errors->has('password_old'))
                                        <div class="form-control-feedback">
                                            {{ $errors->first('password_old') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row {{ $errors->has('password') ? ' has-danger' : '' }}">
                                <label for="password" class="col-sm-2 col-form-label">New</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="password" name="password">
                                    @if ($errors->has('password'))
                                        <div class="form-control-feedback">
                                            {{ $errors->first('password') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password-confirm" class="col-sm-2 col-form-label">Confirm</label>
                                <div class="col-sm-10">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                    <button type="submit" class="btn btn-danger">Change</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-block">
                        <h4 class="card-title">Avatar</h4>
                        <img src="{{ $user->avatarPath() }}" alt="{{ $user->username }} avatar" width="125" height="125">
                        <form method="POST" action="/users/{{ $user->username}}/avatar" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <div class="form-group row {{ $errors->has('user_avatar') ? ' has-danger' : '' }}">
                                <label for="user_avatar" class="col-sm-2 col-form-label">Choose</label>
                                <div class="col-sm-10">
                                    <input type="file" id="user_avatar" name="user_avatar">
                                    @if ($errors->has('user_avatar'))
                                        <div class="form-control-feedback">
                                            {{ $errors->first('user_avatar') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                    <button type="submit" class="btn btn-danger">Change</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop