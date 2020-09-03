@extends('admin.layouts.master')

@section('title', '投票結果')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    {{--    <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>--}}
    {{--    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>--}}
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                投票
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-shopping-bag"></i> 投票</a></li>
                <li class="active">投票結果</li>
            </ol>
        </section>


        <!-- Main content -->
        <section class="content container-fluid">

            <!--------------------------
              | Your Page Content Here |
              -------------------------->
            <div class="container">


                <fieldset>
                    <div class=" col-md-12 form-group">
                        <label class=" control-label">投票類別</label>
                        <div class="inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                <label class="form-control"> @if($vote->type ==0)單選 @else 多選 @endif</label>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-12 form-group">
                        <label class=" control-label">投票名稱</label>
                        <div class=" inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                <label class="form-control"> {{$vote->title}}</label>


                            </div>
                        </div>
                        <label class=" control-label">截止日期</label>
                        <div class=" inputGroupContainer">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                <input disabled type="datetime-local" class="form-control" name="deadline"
                                       id="deadline"
                                       value="{{ old('deadline',date('Y-m-d\TH:i', strtotime($vote->deadline))) }}">

                            </div>
                        </div>
                    </div>


                    <div class="col-md-12  form-group">
                        <label class="control-label">選項</label>

                        <div class=" inputGroupContainer" id="option_list">

                            @foreach($results as $result)
                                <div>

                                    @if($vote->option_type == 1)
                                        <img src="{{$result['img']}}" width="532" height="141" >
                                    @endif

                                    <label>{{$result['option_name']}} </label>
                                        <br>
                                        <span
                                            class="btn btn-default {{$result['class']}}"
                                            style="width: {{ ($result['percentage'] * 100 ) }}%">{{ ($result['percentage'] * 100 ) }}% ({{$result['count']}})</span>
                                    <br/>

                                </div>
                                <br>

                            @endforeach
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-4 control-label"></label>
                        <div class="col-md-4">
                            <a class="btn btn-primary" href="{{route('admin_vote.index')}}">投票首頁</a>
                        </div>
                    </div>

                </fieldset>
            </div>
            <!-- /.row -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
