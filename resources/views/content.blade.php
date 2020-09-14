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

    <!-- <link rel="manifest" href="site.webmanifest"> -->
    <link rel="apple-touch-icon" href="../../e7line/icon.png">
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="../../e7line/css/reset.css">
    <link rel="stylesheet" href="../../e7line/css/layout.css">
    <link rel="stylesheet" href="../../e7line/css/id.css">

    <meta name="theme-color" content="#fafafa">
</head>

<body>
<div class="container">
    <img src="../../e7line/img/id.png" alt="">
    <div class="wrapper">
        <div class="row">
            <span>
                @if($ann->type == 0)
                    【公告】
                @elseif($ann->type == 1)
                    【活動】
                @elseif($ann->type==2)
                    【規範】
                @endif
            </span>
            <span>{{date('Y/m/d',strtotime($ann->create_date))}}</span>
        </div>
        <h1>{{$ann->title}}</h1>
        <div id="content">
            {!! $ann->content !!}
        </div>

    </div>
</div>

<header class="row" align-y="bottom">
    <a href="{{URL::previous()}}" class="row" align-y="center">
        <img src="../../e7line/img/left.svg" alt="">
        返回
    </a>
    <img class="logo" src="../../e7line/img/logo.png" alt="">

</header>
</body>
</html>
