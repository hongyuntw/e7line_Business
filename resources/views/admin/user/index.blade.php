@extends('admin.layouts.master')

@section('title', '管理員列表')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <a href="{{route('admin_users.index')}}">管理員列表</a>
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-shopping-bag"></i>管理員</a></li>
                <li class="active">管理員列表</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">
            @if(session('msg'))
                @if(session('msg')=='')
                    <div class="alert alert-success text-center">{{'Success'}}</div>
                @else
                    <div class="alert alert-danger text-center">{{session('msg')}}</div>
                @endif
            @endif

            @if(session('msgs'))
                <div class="alert-danger alert text-center">
                    @foreach(session('msgs') as $msg)
                        {{$msg}} <br>

                    @endforeach
                </div>
        @endif

        <!--------------------------
              | Your Page Content Here |
              -------------------------->

            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <div class="row">
                                <form name="filter_form" action="{{route('admin_users.index')}}" method="get">

                                    <div class="col-md-2">
                                        <label>使用者種類</label>
                                        <select name="type_filter" class="form-control form-control-sm">
                                            <option value="-1" @if(-1==$type_filter) selected @endif>All</option>
                                            <option value="0" @if(0==$type_filter) selected @endif>會員</option>
                                            <option value="1" @if(1==$type_filter) selected @endif>管理員</option>
                                        </select>
                                        <label>權限</label>
                                        <select name="level_filter" class="form-control form-control-sm">
                                            <option value="-1" @if(-1==$level_filter) selected @endif>All</option>
                                            <option value="1" @if(1==$level_filter) selected @endif>超級管理員</option>
                                            <option value="0" @if(0==$level_filter) selected @endif>一般管理員</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label>會員狀態</label>

                                        <select name="is_active" class="form-control form-control-sm"
                                                id="is_active">
                                            <option value="-1" @if($is_active==-1) selected @endif>All
                                            </option>
                                            <option value="0" @if($is_active==0) selected @endif>停用</option>
                                            <option value="1" @if($is_active==1) selected @endif>正常</option>
                                        </select>
                                        <button type="submit" class=" btn btn-sm bg-blue" style="width: 100%">篩選
                                        </button>
                                    </div>
                                </form>
                                <div class="col-md-3">
                                    <label>搜尋</label><br>
                                    <!-- search form (Optional) -->
                                    <form roe="form" action="{{route('admin_users.index')}}" method="get">
                                        <div class="form-inline">
                                            <select name="search_type" class="form-group form-control"
                                                    style="width: 100%;">
                                                <option value="1" @if(request()->get('search_type')==1) selected @endif>
                                                    公司名稱
                                                </option>
                                                <option value="2" @if(request()->get('search_type')==2) selected @endif>
                                                    使用者名稱
                                                </option>

                                            </select>
                                            <div class="inline">
                                                <input type="text" name="search_info" class="form-control"
                                                       style="width: 80%"
                                                       placeholder="Search..."
                                                       value="@if(request()->get('search_info')) {{request()->get('search_info')}} @endif">
                                                <button type="submit" id="search-btn" style="cursor: pointer"
                                                        style="width: 20%"
                                                        class="btn btn-flat"><i class="fa fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <input hidden name="is_active" value="{{$is_active}}">
                                        <input hidden name="level_filter" value="{{$level_filter}}">
                                        <input hidden name="type_filter" value="{{$type_filter}}">



                                    </form>
                                    <!-- /.search form -->


                                </div>


                                <div class="col-md-3">
                                    <label>匯入</label><br>
                                    <div class="inline">
                                        <form action="{{ route('admin_users.import') }}" method="POST"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <input type="file" name="file" class="form-control-file">
                                            <button class="btn btn-success btn-sm">匯入管理員及會員</button>
                                        </form>

                                    </div>
                                </div>

                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <table class="table table-bordered table-hover" style="width: 100%">
                                    <thead style="background-color: lightgray">
                                    <tr>
                                        <th class="text-center" style="width:15%">公司</th>
                                        <th class="text-center" style="width:15%">名稱</th>
                                        <th class="text-center" style="width:15%">帳號</th>
                                        <th class="text-center" style="width:10%">使用者類型</th>
                                        <th class="text-center" style="width:10%">權限</th>
                                        <th class="text-center" style="width:10%">創立時間</th>
                                        <th class="text-center" style="width:5%">狀態</th>
                                        <th class="text-center" style="width:10%">其他</th>


                                    </tr>
                                    </thead>
                                    @foreach ($users as $user)
                                        <tr class="text-center">
                                            @if($user->id==0)
                                                @continue
                                            @endif
                                            <td>{{ $user->company->name }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email}}</td>
                                            <td>
                                                @if($user->type == 0)
                                                    一般會員
                                                @elseif($user->type == 1)
                                                    後台管理員
                                                @endif
                                            </td>
                                            <td>
                                                @if($user->level==0)
                                                    一般管理員
                                                @elseif($user->level==1)
                                                    超級管理員
                                                @elseif($user->level==2)
                                                    root
                                                @endif
                                            </td>
                                            <td>
                                                {{ date('Y-m-d', strtotime($user->created_at))}}
                                            </td>
                                            <td>
                                                @if($user->is_active==0)
                                                    停用
                                                @else
                                                    正常
                                                @endif
                                            </td>

                                            <td><a class="btn btn-primary btn-sm"
                                                   href="{{route('admin_users.edit',$user->id)}}">編輯 </a></td>


                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer clearfix">
                                {{ $users->links()}}
                            </div>
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
