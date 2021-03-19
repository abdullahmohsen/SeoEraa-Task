@extends('layouts.app')

@section('content')

    <div class="register-box">
        <div class="register-logo">
            <a href="#"><b>Admin</b>LTE</a>
        </div>

        <div class="register-box-body">
            <p class="login-box-msg">Register a new user</p>

    <form method="POST" action="{{ route('register') }}">
        @csrf
        @include('partials._errors')
        <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="{{ __('Name') }}" name="name" value="{{ old('name') }}">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="{{ __('Phone') }}" name="phone" value="{{ old('phone') }}">
            <span class="glyphicon glyphicon-phone form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
            <input type="email" class="form-control" placeholder="{{ __('E-Mail Address') }}" name="email" value="{{ old('email') }}">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="{{ __('Password') }}" name="password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="{{ __('Confirm Password') }}" name="password_confirmation">
            <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
        </div>
        <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>

    </form>
            <br>
            <a href="{{ route('login') }}" class="text-center">I already have an account</a>
        </div>
        <!-- /.form-box -->
    </div>

@endsection
