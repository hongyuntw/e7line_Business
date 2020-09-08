<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta property="og:title" content="">
    <meta property="og:type" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">

    <link rel="manifest" href="site.webmanifest">
    <link rel="apple-touch-icon" href="icon.png">
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="e7line/css/reset.css">
    <link rel="stylesheet" href="e7line/css/layout.css">

    <meta name="theme-color" content="#fafafa">
</head>

<body>
<div class="container">
    <p class="row" align-x="space-between" align-y="center">
        <span>台灣雅瑪多</span>
        <span>42388877</span>
    </p>
    @if (session('member'))
        <div class="alert alert-success">
            你已經登入
        </div>
        @foreach(Session::get('member') as $key => $val)
            {{$key}} {{$val}}
        @endforeach

        <a href="{{route('front_end.logout')}}">登出</a>
    @else
        <div class="alert alert-success">
            尚未登入
        </div>
    @endif
    <ul class="grid">
        <li class="white">
            <a href="#">
                <span>好康商品</span>
            </a>
        </li>
        <li>
            <a href="{{route('announcement')}}">
                <span>福委公告</span>
            </a>
        </li>
        <li>
            <a href="#">
                <span>活動投票</span>
            </a>
        </li>
        <li>
            <a href="#">
                <span>各式查詢</span>
            </a>
        </li>

    </ul>
</div>

<header class="row" align-y="bottom">
    <img class="logo" src="e7line/img/logo.png" alt="">
    <button class="column" align-x="center">
        <img src="e7line/img/plus.svg" alt="">
        <span>福委平台</span>
    </button>
    <img class="menu" src="e7line/img/menu.svg" alt="">
</header>
</body>

<style>
    header {
        position: fixed;
        left: 0;
        top: 0;
        height: 106px;
        width: 100%;
        padding-left: 15px;
        padding-right: 20px;
        background-color: #F7F8F9;
    }

    header > .logo {
        cursor: pointer;
    }

    header > button {
        position: relative;
        left: -5px;
        padding-bottom: 11px;
        border: none;
        background: none;
        outline: none;
        cursor: pointer;
        font-weight: 500;
        color: #d99694;
    }

    header > button > img {
        width: 24px;
        margin-bottom: 2px;
    }

    header > .menu {
        margin-left: auto;
        padding-bottom: 19px;
        cursor: pointer;
    }

    .container {
        margin-top: 106px;
    }

    p {
        padding: 6px 19px 6px 26px;
        background-color: #FFEBEB;
    }

    p > span:first-child {
        color: #707070;
    }

    p > span:last-child {
        font-weight: 600;
        font-size: 22px;
        color: #8e8e8e;

    }

    .grid {
        margin-top: 24px;
        padding-left: 19px;
        padding-right: 19px;
        grid-template-columns: 1fr 1fr;
        grid-column-gap: 15px;
        grid-row-gap: 19px;
    }

    .grid > li > a {
        height: 183px;
        background-repeat: no-repeat;
        border-radius: 9px;
        display: flex;
        justify-content: center;
        align-items: flex-end;
        padding-bottom: 28px;
        color: #3E3C3C;
        cursor: pointer;
        text-decoration: none;
        box-shadow: 0px 0px 9px rgba(0, 0, 0, 0.16);
    }

    .grid > li > a > span {
        font-size: 20px;
    }

    .grid > li.white > a {
        color: #FFFFFF;
    }


    .grid > li:nth-child(n + 1) > a {
        background-color: #F0635F;
    }

    .grid > li:nth-child(n + 2) > a {
        background-color: #89D66C;
    }

    .grid > li:nth-child(n + 3) > a {
        background-color: #F89B56;
    }

    .grid > li:nth-child(n + 4) > a {
        background-color: #80C3ED;
    }

    .grid > li:nth-child(1) > a {
        background-image: url('e7line/img/grid-icon-1.svg');
        background-position-x: center;
        background-position-y: 15px;
    }

    .grid > li:nth-child(2) > a {
        background-image: url('e7line/img/grid-icon-2.svg');
        background-position-x: center;
        background-position-y: 30px;
    }

    .grid > li:nth-child(3) > a {
        background-image: url('e7line/img/grid-icon-3.svg');
        background-position-x: center;
        background-position-y: 23px;
    }

    .grid > li:nth-child(4) > a {
        background-image: url('e7line/img/grid-icon-4.svg');
        background-position-x: center;
        background-position-y: 26px;
    }

</style>

</html>
