{{--@extends('layouts.app')--}}

{{--@section('content')--}}
{{--    <h1>前端登入測試</h1>--}}
{{--    <div class="container">--}}
{{--        <div class="row">--}}
{{--            <div class="col-md-8 col-md-offset-2">--}}
{{--                <div class="panel panel-default">--}}
{{--                    @if(session('message'))--}}
{{--                        <div class="alert alert-danger text-center">{{session('message')}}</div>--}}
{{--                    @endif--}}

{{--                    @csrf--}}

{{--                    <div class="panel-heading">Login</div>--}}

{{--                    <div class="panel-body">--}}
{{--                        <form class="form-horizontal" method="POST" action="{{route('front_end.login')}}">--}}
{{--                            {{ csrf_field() }}--}}

{{--                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">--}}
{{--                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>--}}

{{--                                <div class="col-md-6">--}}
{{--                                    <input id="email" type="email" class="form-control" name="email"--}}
{{--                                           value="{{ old('email') }}" required autofocus>--}}

{{--                                    @if ($errors->has('email'))--}}
{{--                                        <span class="help-block">--}}
{{--                                        <strong>{{ $errors->first('email') }}</strong>--}}
{{--                                    </span>--}}
{{--                                    @endif--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">--}}
{{--                                <label for="password" class="col-md-4 control-label">Password</label>--}}

{{--                                <div class="col-md-6">--}}
{{--                                    <input id="password" type="password" class="form-control" name="password" required>--}}

{{--                                    @if ($errors->has('password'))--}}
{{--                                        <span class="help-block">--}}
{{--                                        <strong>{{ $errors->first('password') }}</strong>--}}
{{--                                    </span>--}}
{{--                                    @endif--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="form-group">--}}
{{--                                <div class="col-md-6 col-md-offset-4">--}}
{{--                                    <div class="checkbox">--}}
{{--                                        <label>--}}
{{--                                            <input type="checkbox"--}}
{{--                                                   name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me--}}
{{--                                        </label>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="form-group">--}}
{{--                                <div class="col-md-8 col-md-offset-4">--}}
{{--                                    <button type="submit" class="btn btn-primary">--}}
{{--                                        Login--}}
{{--                                    </button>--}}

{{--                                    <a class="btn btn-link" href="{{ route('password.request') }}">--}}
{{--                                        Forgot Your Password?--}}
{{--                                    </a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </form>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}
        <!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <title>e7line登入</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta property="og:title" content="">
    <meta property="og:type" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="apple-touch-icon" href="../../e7line/icon.png">
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="../../e7line/css/reset.css">
    <link rel="stylesheet" href="../../e7line/css/layout.css">
    <link rel="stylesheet" href="../../e7line/css/login.css">

    <meta name="theme-color" content="#fafafa">
</head>

<body>

<div class="container column" align-x="center" align-y="center">
    <div class="logo row" align-x="center" align-y="bottom">
       <a href="/"><img class="logo" src="../../e7line/img/logo.png" alt=""></a>
        {{--        <button class="column" align-x="center">--}}
        {{--            <img src="../../e7line/img/plus.svg" alt="">--}}
        {{--            <span>福委平台</span>--}}
        {{--        </button>--}}
    </div>
    @if(session('message'))
        <div class="alert alert-danger text-center">{{session('message')}}</div>
    @endif
    <form class="form-horizontal" method="POST" action="{{route('front_end.login')}}">
        {{ csrf_field() }}

        <input type="email" id="email" name="email" required autofocus placeholder="電子郵件">
        @if ($errors->has('email'))
            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
        @endif
        <input type="password" id="password" name="password" required placeholder="您的密碼">
        @if ($errors->has('password'))
            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
        @endif
        <input type="submit" value="登入">
    </form>

    <div class="row another" align-x="space-between" align-self="full">
        <a href="https://www.e7line.com/Member/forgetpassword.aspx" class="orange">忘記密碼?</a>
        &nbsp;&nbsp;
        <a href="https://www.e7line.com/Register/default.aspx" class="green">註冊帳號</a>
    </div>


</div>


</body>
</html>
