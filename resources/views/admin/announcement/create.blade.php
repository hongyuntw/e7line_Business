@extends('admin.layouts.master')

@section('title', '新增公告')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                新增公告
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-shopping-bag"></i> 公告</a></li>
                <li class="active">新增公告</li>
            </ol>
        </section>


        <!-- Main content -->
        <section class="content container-fluid">

            <!--------------------------
              | Your Page Content Here |
              -------------------------->
            <div class="container">

                <form enctype="multipart/form-data" class="well form-horizontal" action="{{ route('admin_announcement.store') }}" method="post">
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
                            <label class=" control-label">類別</label>
                            <div class="inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                    <select name="type" class="form-control">
                                        <option value="0">通知</option>
                                        <option value="1">活動</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <label class=" control-label">標題</label>
                            <div class=" inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                    <input type="text" class="form-control" name="title" placeholder="請輸入標題"
                                           value="{{ old('title') }}" >

                                </div>
                            </div>
                        </div>


                        <div class="col-md-12  form-group">
                            <label class="control-label">內容</label>
                            <div class=" inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-phone"></i></span>


                                    <textarea id="content" rows="10" style="size: auto" class="form-control" name="content" >{{old('content')}}</textarea>
                                </div>
                            </div>
                        </div>
                        <script type="text/javascript">
                            var content = new nicEditor().panelInstance('content');
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
