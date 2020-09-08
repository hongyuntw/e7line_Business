@extends('admin.layouts.master')

@section('title', '編輯權限')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <H1>編輯權限</H1>
            <ol class="breadcrumb">
                <li><a href="{{route('admin_permission.index')}}"><i class="fa fa-shopping-bag"></i> 權限</a></li>
                <li class="active">編輯權限</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <!--------------------------
              | Your Page Content Here |
              -------------------------->
            <div class="container">

                <form class="well form-horizontal" action="{{ route('admin_permission.update',$permission->id) }}"
                      method="post">
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
                        <div class="form-group">
                            <label class="col-md-4 control-label">權限名稱</label>
                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                    <input disabled type="text" class="form-control"
                                           value="{{ old('name',$permission->module->name) }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">公司名稱</label>
                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                    <input disabled type="text" class="form-control"
                                           value="{{ old('name',$permission->company->name) }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">權限</label>
                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group">
                                        <span class="input-group-addon"><i
                                                    class="glyphicon glyphicon-envelope"></i></span>
                                    <select name="permission" class="form-control">
                                        <option value="0" @if($permission->permission ==0 ) selected @endif>無限制</option>
                                        <option value="1" @if($permission->permission ==1 ) selected @endif>只限root/超級管理
                                        </option>

                                        @if(Auth::user()->level == 2)
                                            <option value="2" @if($permission->permission ==2 ) selected @endif>只限root
                                            </option>
                                        @endif

                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-md-4 control-label"></label>
                            <div class="col-md-4">
                                <input hidden name="source_html" value="{{$source_html}}">
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
