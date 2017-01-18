@extends('layouts.app')

@section('title', 'Register')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <form method="POST" action="/register">
                {{ csrf_field() }}
                <div class="form-group row {{ $errors->has('name') ? ' has-danger' : '' }}">
                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" autofocus>
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
                        <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}">
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
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">
                        @if ($errors->has('email'))
                            <div class="form-control-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-group row {{ $errors->has('password') ? ' has-danger' : '' }}">
                    <label for="password" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input id="password" type="password" class="form-control" name="password">
                        @if ($errors->has('password'))
                            <div class="form-control-feedback">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password-confirm" class="col-sm-2 col-form-label">Confirm Password</label>
                    <div class="col-sm-10">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                        <button type="submit" class="btn btn-outline-danger">Register</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-sm-10 offset-sm-2">
            <p><span class="text-muted">Already have an account? </span><a href="/login">Login</a></p>
        </div>
    </div>
@endsection
