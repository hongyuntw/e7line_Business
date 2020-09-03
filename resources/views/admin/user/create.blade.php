@extends('admin.layouts.master')

@section('title', '新增管理員')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <H1>新增管理員</H1>
            <ol class="breadcrumb">
                <li><a href="{{route('admin_users.index')}}"><i class="fa fa-shopping-bag"></i> 管理員</a></li>
                <li class="active">新增管理員</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <!--------------------------
              | Your Page Content Here |
              -------------------------->
            <div class="container">

                <form class="well form-horizontal" action="{{ route('admin_users.store') }}" method="post">
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
                            <label class="col-md-4 control-label">使用者名稱</label>
                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="請輸入名稱"
                                           value="{{ old('name') }}">
                                </div>
                            </div>
                        </div>

                        @if(Auth::user()->level == 2)
                            <div class="form-group">
                                <label class="col-md-4 control-label">公司</label>
                                <div class="col-md-4 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <select id="company" name="company_id">
                                            <option value="-1"> 選擇公司</option>
                                            @foreach($companies as $company)
                                                <option value="{{$company->id}}">{{$company->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <script>
                                    $('#company').selectize();
                                </script>
                            </div>
                            <div class="form-group">
                                <label class="col-md-4 control-label">權限</label>
                                <div class="col-md-4 inputGroupContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i
                                                    class="glyphicon glyphicon-envelope"></i></span>
                                        <select name="level" class="form-control">
                                            <option value="0">一般管理員</option>
                                            <option value="1">超級管理員</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        @endif


                        <div class="form-group">
                            <label class="col-md-4 control-label">信箱(帳號)</label>
                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                                    <input type="text" class="form-control" name="email" placeholder="請輸入信箱"
                                           value="{{ old('email') }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">密碼</label>
                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                                    <input type="password" class="form-control" name="password" placeholder="請輸入密碼">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">再次輸入密碼</label>
                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                                    <input type="password" class="form-control" name="password_confirmation"
                                           placeholder="請再次輸入密碼">
                                </div>
                            </div>
                        </div>


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
