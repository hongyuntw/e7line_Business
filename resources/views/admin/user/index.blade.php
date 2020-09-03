@extends('admin.layouts.master')

@section('title', '使用者列表')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                使用者列表
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-shopping-bag"></i>使用者管理</a></li>
                <li class="active">使用者列表</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

            <!--------------------------
              | Your Page Content Here |
              -------------------------->

            <div class="row">
                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <div class="box-tools">


                            </div>

                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table class="table table-bordered table-hover" style="width: 100%">
                                <thead style="background-color: lightgray">
                                <tr>
                                    <th class="text-center" style="width:10%">公司</th>
                                    <th class="text-center" style="width:30%">名稱</th>
                                    <th class="text-center" style="width:20%">帳號</th>
                                    <th class="text-center" style="width:10%">使用者類型</th>
                                    <th class="text-center" style="width:10%">權限</th>
                                    <th class="text-center" style="width:10%">創立時間</th>
                                    <th class="text-center" style="width:20%">其他</th>


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
