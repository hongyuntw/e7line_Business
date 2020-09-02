@extends('admin.layouts.master')

@section('title', '主控台')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                首頁
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{route('admin_dashboard.index')}}"><i class="fa fa-shopping-bag"></i> 首頁</a></li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content container-fluid">

            <!--------------------------
              | Your Page Content Here |
              -------------------------->



        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection






