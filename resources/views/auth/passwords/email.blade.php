@extends('layouts.app')

@section('title', 'Reset Password')

<!-- Main Content -->
@section('content')
    <div class="row">
        <div class="col-sm-12">
            @if (session('status'))
                <div class="row">
                    <div class="col-sm-10 offset-sm-2">
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    </div>
                </div>
            @endif
            <form role="form" method="POST" action="/password/email">
                {{ csrf_field() }}
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
                <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10">
                        <button type="submit" class="btn btn-outline-danger">Send Password Reset Link</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
