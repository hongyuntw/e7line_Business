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
    <link rel="stylesheet" href="../../e7line/css/transport.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

    <meta name="theme-color" content="#fafafa">
</head>

<body>
<div class="container">
    <h1>{{$vote->title}}</h1>
    <p class="row" align-x="space-between" align-y="center">
        <span>建立者：{{$vote->user->name}}</span>
        <span>將在{{(new DateTime($vote->deadline))->diff(now())->format("%a")}}天後結束活動調查</span>
    </p>
    <form action="{{route('vote_submit',$vote->id)}}" method="post">
        @csrf
        <ul class="grid">
            @foreach($vote->vote_options as $option)
                <li>
                    <label for="{{$option->id}}" class="column">
                        <img src="{{$option->image_url}}" alt="" width="450" height="519">
                        <div class="row" align-x="center" align-y="center">
                            <input type="checkbox" id="{{$option->id}}" name="choice[{{$option->id}}]"
                                   @if(in_array($option->id,$old_option_ids)) checked @endif>
                            <label for="{{$option->id}}"></label>
                            <label for="{{$option->id}}">{{$option->name}}</label>
                        </div>
                    </label>
                </li>
            @endforeach

        </ul>
        <button class="center">確認送出</button>

    </form>
</div>


<header class="row" align-x="center" align-y="bottom">
    <a href="/vote" class="row" align-y="center">
        <img src="../../e7line/img/left.svg" alt="">
        返回
    </a>
    <h1>投票</h1>
    <img class="menu" src="../../e7line/img/menu.svg" alt="">
</header>

</body>


<script>
    function choiceChanged(id, checkbox) {
        var string = 'choice[' + id + ']';
        var node = document.getElementById(string);
        console.log(checkbox.checked);
    }

    function triggerCheckbox(id) {
        document.getElementById(id).click();
    }

    if ('{{$vote->type}}' == 0) {
        $("input:checkbox").change(function () {
            // in the handler, 'this' refers to the box clicked on
            var $box = $(this);
            if ($box.is(":checked")) {
                // the name of the box is retrieved using the .attr() method
                // as it is assumed and expected to be immutable
                // var group = "input:checkbox[name='" + $box.attr("name") + "']";
                var group = "input:checkbox";

                // the checked state of the group/box on the other hand will change
                // and the current value is retrieved using .prop() method
                $(group).prop("checked", false);
                $box.prop("checked", true);
            } else {
                $box.prop("checked", false);
            }
        });

    }

</script>

</html>
