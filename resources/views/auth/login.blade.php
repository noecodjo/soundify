@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <form method="POST" action="/login">
                {{ csrf_field() }}
                <div class="form-group row {{ $errors->has('username') ? ' has-danger' : '' }}">
                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                        <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" autofocus>
                        @if ($errors->has('username'))
                            <div class="form-control-feedback">
                                {{ $errors->first('username') }}
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
                    <div class="col-sm-10 offset-sm-2">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" name="remember"> Remember Me
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                        <button type="submit" class="btn btn-outline-danger">Login</button>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                        <a href="/password/reset">Forgot Your Password?</a>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-sm-10 offset-sm-2">
            <p><span class="text-muted">Don't have an account? </span><a href="/register">Register</a></p>
        </div>
    </div>
@endsection
<!-- <div class="form-group">
    <div class="col-md-8 col-md-offset-4">
        <button type="submit" class="btn btn-primary">
            Login
        </button>

        <a class="btn btn-link" href="{{ url('/password/reset') }}">
            Forgot Your Password?
        </a>
    </div>
</div> -->
