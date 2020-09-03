@extends('admin.layouts.master')

@section('title', '編輯公司')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <H1>編輯公司</H1>
            <ol class="breadcrumb">
                <li><a href="{{route('admin_company.index')}}"><i class="fa fa-shopping-bag"></i> 公司</a></li>
                <li class="active">編輯公司</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <!--------------------------
              | Your Page Content Here |
              -------------------------->
            <div class="container">

                <form class="well form-horizontal" action="{{ route('admin_company.update',$company->id) }}" method="post">
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
                    @if(session('msg'))
                        @if(session('msg')=='')
                            <div class="alert alert-success text-center">{{'Success'}}</div>
                        @else
                            <div class="alert alert-danger text-center">{{session('msg')}}</div>
                        @endif
                    @endif

                    <fieldset>
                        <div class="form-group">
                            <label class="col-md-4 control-label">公司名稱</label>
                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="請輸入名稱"
                                           value="{{ old('name',$company->name) }}">
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-md-4 control-label">狀態</label>
                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group">
                                        <span class="input-group-addon"><i
                                                    class="glyphicon glyphicon-envelope"></i></span>
                                    <select name="is_active" class="form-control">
                                        <option value="0" @if($company->is_active ==0 ) selected @endif>停用</option>
                                        <option value="1" @if($company->is_active ==1 ) selected @endif>正常</option>
                                    </select>
                                </div>
                            </div>
                        </div>




                        <div class="form-group">
                            <label class="col-md-4 control-label">統編</label>
                            <div class="col-md-4 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                                    <input type="text" class="form-control" name="tax_id" placeholder="請輸入密碼"
                                    value="{{old('tax_id',$company->tax_id)}}">
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
