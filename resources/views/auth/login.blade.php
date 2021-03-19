@extends('layouts.app')

@section('content')
<div class="login-box">

    <div class="login-logo">
        <a href="#"><b>Admin</b>LTE</a>
    </div><!-- end of login lgo -->

    <div class="login-box-body">
        <p class="login-box-msg">Sign in</p>

        <form action="{{ route('login') }}" method="post">
            @csrf
            @include('partials._errors')

            <div class="form-group has-feedback">
                <input type="email" name="email" class="form-control" placeholder="@lang('site.email')">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <input type="password" name="password" class="form-control" placeholder="@lang('site.password')">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>

            <div class="form-group">
                <label style="font-weight: normal;"><input type="checkbox" name="remember"> @lang('site.remember_me')</label>
            </div>

            <button type="submit" class="btn btn-primary btn-block btn-flat">@lang('site.login')</button>

        </form><!-- end of form -->

        <br>
        <a href="{{ route('register') }}" class="text-center">Register a new user</a>

    </div><!-- end of login body -->

</div><!-- end of login-box -->

@endsection
