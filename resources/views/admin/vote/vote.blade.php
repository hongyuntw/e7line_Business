@extends('admin.layouts.master')

@section('title', '投票')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                投票
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-shopping-bag"></i> 投票</a></li>
                <li class="active">投票</li>
            </ol>
        </section>


        <!-- Main content -->
        <section class="content container-fluid">

            <!--------------------------
              | Your Page Content Here |
              -------------------------->
            <div class="container">

                <form enctype="multipart/form-data" class="well form-horizontal" onsubmit="return validateForm()"
                      action="{{ route('admin_vote.submitVote',$vote->id) }}" method="post">
                    @csrf

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                &times;
                            </button>
                            <h4><i class="icon fa fa-ban"></i> 錯誤！</h4>
                            請修正以下表單錯誤：
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
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

                                @foreach($vote->vote_options as $vote_option)

                                    <div class="input-group">
                                    <span class="input-group-addon">
                                        <input type="checkbox" name="choice[{{$vote_option->id}}]" id="choice[{{$vote_option->id}}]" >
{{--                                        <input type="hidden" value="0" name="choice[{{$vote_option->id}}]" id="choice[{{$vote_option->id}}]">--}}
                                    </span>
                                        <label ondblclick="triggerCheckbox('choice[{{$vote_option->id}}]')" class="form-control">{{$vote_option->name}}</label>
                                        @if($vote->option_type == 1)
                                            <img  style="display: block"
                                                 src="{{$vote_option->image_url}}" width="100" height="100">
                                        @endif
                                    </div>

                                @endforeach
                            </div>
                        </div>

                        <script>
                            function choiceChanged(id,checkbox){
                                var string = 'choice[' + id + ']';
                                var node = document.getElementById(string);
                                console.log(checkbox.checked);
                                // node.value = checkbox.check();
                            }
                            function triggerCheckbox(id){
                                // var node = document.getElementById(id);
                                // node.checked = !node.checked
                                // $("#" + id).prop("checked", true);
                                document.getElementById(id).click();

                            }

                            if('{{$vote->type}}' == 0){
                                $("input:checkbox").change( function() {
                                    // in the handler, 'this' refers to the box clicked on
                                    var $box = $(this);
                                    if ($box.is(":checked")) {
                                        // the name of the box is retrieved using the .attr() method
                                        // as it is assumed and expected to be immutable
                                        var group = "input:checkbox[name='" + $box.attr("name") + "']";
                                        var group = "input:checkbox";

                                        // the checked state of the group/box on the other hand will change
                                        // and the current value is retrieved using .prop() method
                                        $(group).prop("checked", false);
                                        $box.prop("checked", true);
                                    }
                                    else {
                                        $box.prop("checked", false);
                                    }
                                });

                            }

                        </script>


                        <div class="form-group">
                            <label class="col-md-4 control-label"></label>
                            <div class="col-md-4">
                                <a class="btn btn-danger" href="{{ URL::previous() }}">取消</a>
                                <button type="submit" class="btn btn-primary">確認送出</button>
                            </div>
                        </div>

                    </fieldset>
                </form>
            </div>
            <!-- /.row -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
