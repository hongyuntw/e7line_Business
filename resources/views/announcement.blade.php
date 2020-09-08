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
    <div class="search row" align-y="center">
        <img src="e7line/img/search.svg" alt="">
        <input type="text" placeholder="請搜尋公告內容">
    </div>
    <ul class="grid">
        <li>
            <a href="#">
                <div class="image"></div>
                <div class="row">
                    <img class="plus" src="e7line/img/plus.svg" alt="">
                    <div class="column">
                        <div class="row" align-x="space-between">
                            <span class="pink">【公告】</span>
                            <span class="date">2020/01/01</span>
                        </div>
                        <div class="row" align-x="space-between">
                            <h2>109年度福委會發放109年7月生日禮券</h2>
                            <img src="e7line/img/right.svg" alt="">
                        </div>
                    </div>
                </div>
            </a>
        </li>
        <li>
            <a href="#">
                <div class="image"></div>
                <div class="row">
                    <img class="plus" src="e7line/img/plus.svg" alt="">
                    <div class="column">
                        <div class="row" align-x="space-between">
                            <span class="pink">【公告】</span>
                            <span class="date">2020/01/01</span>
                        </div>
                        <div class="row" align-x="space-between">
                            <h2>109年度福委會發放109年7月生日禮券</h2>
                            <img src="e7line/img/right.svg" alt="">
                        </div>
                    </div>
                </div>
            </a>
        </li>
        <li>
            <a href="#">
                <div class="image"></div>
                <div class="row">
                    <img class="plus" src="e7line/img/plus.svg" alt="">
                    <div class="column">
                        <div class="row" align-x="space-between">
                            <span class="pink">【公告】</span>
                            <span class="date">2020/01/01</span>
                        </div>
                        <div class="row" align-x="space-between">
                            <h2>109年度福委會發放109年7月生日禮券</h2>
                            <img src="e7line/img/right.svg" alt="">
                        </div>
                    </div>
                </div>
            </a>
        </li>
        <li>
            <a href="#">
                <div class="image"></div>
                <div class="row">
                    <img class="plus" src="e7line/img/plus.svg" alt="">
                    <div class="column">
                        <div class="row" align-x="space-between">
                            <span class="pink">【公告】</span>
                            <span class="date">2020/01/01</span>
                        </div>
                        <div class="row" align-x="space-between">
                            <h2>109年度福委會發放109年7月生日禮券</h2>
                            <img src="e7line/img/right.svg" alt="">
                        </div>
                    </div>
                </div>
            </a>
        </li>
    </ul>
</div>

<header class="row" align-x="center" align-y="bottom">
    <a href="/" class="row" align-y="center">
        <img src="e7line/img/left.svg" alt="">
        返回
    </a>
    <h1>福委會公告</h1>
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
        background-color: #F7F8F9;
    }

    header > a {
        position: absolute;
        left: 15px;
        bottom: 12px;
        font-size: 19px;
        color: #6e6e6e;
        text-decoration: none;
    }

    header > h1 {
        padding-bottom: 12px;
        font-weight: 600;
        font-size: 22px;
        color: #535353;
    }

    header > .menu {
        position: absolute;
        cursor: pointer;
        right: 20px;
        bottom: 19px;
    }

    .container {
        margin-top: 106px;
    }

    .search {
        height: 42px;
        padding: 11px 18px;
        margin: 0 12px;
        border-radius: 100%;
        background: white;
        border-radius: 21px;
    }

    .search input {
        flex: 1 0 auto;
        margin-left: 12px;
        border: none;
        font-weight: normal;
        font-size: 17px;
        color: #c9c9c9;
        outline: none;
    }

    .search input::-webkit-input-placeholder {
        color: #c9c9c9;
    }

    .grid {
        margin-top: 17px;
        padding-left: 15px;
        padding-right: 19px;
        grid-row-gap: 12px;
    }

    .grid > li > a {
        display: block;
        border-radius: 9px;
        background: white;
        text-decoration: none;

        filter: drop-shadow(0px 0px 9px rgba(0, 0, 0, 0.16));
    }

    .grid > li > a > .image {
        height: 107px;
        background: url('./e7line/img/list-image.png');
        background-position: center;
        background-size: cover;
    }

    .grid > li > a > .row {
        padding: 10px 8px 12px 13px;
    }

    .grid > li > a > .row > .plus {
        margin-top: 22px;
        margin-right: 8px;
        width: 18px;
        height: 18px;
        flex-shrink: 0;
    }

    .grid > li > a > .row > .column {
        flex: 1 1 auto;
    }

    .grid > li > a > .row > .column > .row + .row {
        margin-top: 3px;
    }

    .grid > li a .pink {
        font-size: 13px;
        color: #f48282;
    }

    .grid > li a .date {
        font-size: 13px;
        color: #b4b4b4;
    }

    .grid > li a h2 {
        font-size: 15px;
        color: #3e3c3c;

        width: 244px;
        flex: 1 1 100px;
        white-space: nowrap;
        text-overflow: ellipsis;
        overflow: hidden;
    }
</style>
</html>
