<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <title>首頁</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta property="og:title" content="">
    <meta property="og:type" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="apple-touch-icon" href="e7line/icon.png">
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="e7line/css/reset.css">
    <link rel="stylesheet" href="e7line/css/layout.css">
    <link rel="stylesheet" href="e7line/css/home.css">
    {{--    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">--}}

    <meta name="theme-color" content="#fafafa">
</head>

<body>


<div class="container">
    <p class="row" align-x="space-between" align-y="center">
        @if (session('member'))

            <span>
                @if(Session::get('member')['company'])
                    {{Session::get('member')['company']->name}}({{Session::get('member')['BusinessCode']}})
                @else
                    ({{Session::get('member')['BusinessCode']}})
                @endif
            </span>



            {{--            <a href="{{route('front_end.logout')}}">登出</a>--}}
        @else
            <span>尚未登入</span>
            <span><a style="text-decoration: none" href="{{route('front_end.login')}}">登入</a></span>
        @endif
        {{--        <span>台灣雅瑪多</span>--}}
        {{--        <span>42388877</span>--}}
    </p>
    @if(session('message'))
        <div style="text-align: center;color: #a94442;background-color: #f2dede; border-color: #ebccd1">
            {{Session::get('message')}}
        </div>
    @endif
    <form id="e7lineLoginForm" action="https://www.e7line.com/API/outsideLogin.aspx" method="post">
        <input type="hidden" value="{{$email}}" name="Email">
        <input type="hidden" value="{{$pwd}}" name="Password">
    </form>
    <ul class="grid">
        <li class="white">
            <a onclick="document.getElementById('e7lineLoginForm').submit();">
                <span>好康商品</span>
            </a>
        </li>
        <li>
            <a href="/announcement">
                <span>福委公告</span>
            </a>
        </li>
        <li>
            <a href="/vote">
                <span>活動投票</span>
            </a>
        </li>
        <li>
            <a href="/search">
                <span>各式查詢</span>
            </a>
        </li>
    </ul>
</div>

<header class="row" align-y="bottom">
    <img class="logo" src="e7line/img/logo.png" alt="">
    @if (session('member'))
        @if(Session::get('member')['Email'])
            <span style="height: 30px">Hi. {{Session::get('member')['Email']}}</span>
        @endif
    @endif
    <img class="menu" src="e7line/img/menu.svg" alt="">

</header>


<nav class="close">
    <div class="mask"></div>
    <div class="menu">
        <ul>
            <li><a href="https://www.e7line.com/">好康商品</a></li>
            <li><a href="/announcement">福委公告</a></li>
            <li><a href="/vote">活動投票</a></li>
            <li><a href="/search">各式查詢</a></li>
        </ul>
        @if (session('member'))
            <button><a style="text-decoration: none" href="{{route('front_end.logout')}}">登出</a></button>
        @else
            <button><a style="text-decoration: none" href="{{route('front_end.login')}}">登入</a></button>

        @endif
        <img class="close" src="e7line/img/close.png" alt="">
    </div>
</nav>


</body>
<script>
    const menuButton = document.querySelector('header .menu');
    const close = document.querySelector('nav .close');
    const nav = document.querySelector('nav');
    const mask = document.querySelector('nav .mask');

    menuButton.addEventListener('click', () => {
        nav.classList.remove('close')
    });
    close.addEventListener('click', () => {
        nav.classList.add('close')
    });
    mask.addEventListener('click', () => {
        nav.classList.add('close')
    });
</script>
</html>
