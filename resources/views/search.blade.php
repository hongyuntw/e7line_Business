<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <title>各式查詢</title>
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
    <link rel="stylesheet" href="e7line/css/search.css">

    <meta name="theme-color" content="#fafafa">
</head>

<body>
<div class="container">
    <div class="search row" align-y="center">
        <form  action="/announcement" method="get">
            <button style="background-color: Transparent;border: none;cursor:pointer;overflow: hidden;outline:none;" type="submit"><img src="e7line/img/search.svg" style="border: 0" alt=""></button>
            <input name="search_info" type="text" placeholder="請輸入查詢內容" value="{{$search_info}}">
        </form>
    </div>
    <ul class="grid">
        @foreach($announcements as $ann)
            <li>
                <a href="#">
                    <div class="image"></div>
                    <div class="row">
                        {{--                        <img class="plus" src="e7line/img/plus.svg" alt="">--}}
                        <div class="column">
                            <div class="row" align-x="space-between">
                            <span class="pink">
                                【規範】
                            </span>
                                <span class="date">{{date('Y/m/d',strtotime($ann->create_date))}}</span>
                            </div>
                            <div class="row" align-x="space-between">
                                <h2>{{$ann->title}}</h2>
                                <img src="e7line/img/right.svg" alt="">
                            </div>
                        </div>
                    </div>
                </a>
            </li>

        @endforeach

    </ul>
</div>

<header class="row" align-x="center" align-y="bottom">
    <a href="/" class="row" align-y="center">
        <img src="e7line/img/left.svg" alt="">
        返回
    </a>
    <h1>各式查詢</h1>
    <img class="menu" src="e7line/img/menu.svg" alt="">
</header>
<nav class="close">
    <div class="mask"></div>
    <div class="menu">
        <ul>
            <li><a href="transport.html">好康商品</a></li>
            <li><a href="/announcement">福委公告</a></li>
            <li><a href="vote.html">活動投票</a></li>
            <li><a href="">各式查詢</a></li>
        </ul>
        <button>登出</button>
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
