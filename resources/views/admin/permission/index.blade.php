@extends('admin.layouts.master')

@section('title', '權限列表')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <a href="{{route('admin_permission.index')}}">權限列表</a>
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-shopping-bag"></i> 權限</a></li>
                <li class="active">權限列表</li>
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
                            <div class="row">
                                <form name="filter_form" action="{{route('admin_permission.index')}}" method="get">
                                    <div class="col-md-4">
                                        <label>權限</label>
                                        <select name="permission_filter" class="form-control form-control-sm">
                                            <option value="-1" @if($permission_filter == -1 ) selected @endif>All
                                            </option>
                                            <option value="0" @if($permission_filter == 0 ) selected @endif>無限制</option>
                                            <option value="1" @if($permission_filter == 1 ) selected @endif>
                                                只限root/超級管理
                                            </option>
                                            <option value="2" @if($permission_filter == 2 ) selected @endif>只限root
                                            </option>
                                        </select>


                                    </div>
                                    <div class="col-md-2">
                                        <label>排序方式 </label>
                                        <select name="sortBy" class="form-control form-control-sm">
                                            @foreach(['module_id','company_id',] as $col)
                                                <option @if($sortBy == $col) selected
                                                        @endif value="{{$col}}">{{$sortBy_text[$loop->index]}}</option>
                                            @endforeach
                                        </select>
                                        <button type="submit"
                                                class=" btn btn-sm bg-blue"
                                                style="width: 100%">篩選
                                        </button>
                                    </div>

                                </form>
                                <div class="col-md-3 col-3">
                                    <label>搜尋</label><br>
                                    <!-- search form (Optional) -->
                                    <form roe="form" action="{{route('admin_permission.index')}}" method="get">
                                        <div class="form-inline">
                                            <select name="search_type" class="form-group form-control">
                                                <option value="1" @if(request()->get('search_type')==1) selected @endif>
                                                    模組名稱
                                                </option>
                                                <option value="2" @if(request()->get('search_type')==2) selected @endif>
                                                    公司名稱
                                                </option>
                                            </select>
                                            <br>
                                            <div class="inline">
                                                <input type="text" name="search_info" class="form-control"
                                                       placeholder="Search..."
                                                       value="@if(request()->get('search_info')) {{request()->get('search_info')}} @endif">
                                                <button type="submit" id="search-btn" style="cursor: pointer"
                                                        class="btn btn-flat"><i class="fa fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <input hidden name="permission_filter" value="{{$permission_filter}}">
                                        <input hidden name="sortBy" value="{{$sortBy}}">

                                    </form>
                                    <!-- /.search form -->

                                    {{--                                </div>--}}

                                </div>


                            </div>

                            <!-- /.box-header -->
                            <div class="box-body ">

                                <table class="table table-bordered table-hover" width="100%">
                                    <thead style="background-color: lightgray">
                                    <tr>
                                        <th class="text-center" style="width:30%">模組名稱</th>
                                        <th class="text-center" style="width:30%">公司名稱</th>
                                        <th class="text-center" style="width:20%">權限</th>
                                        <th class="text-center" style="width:20%">其他</th>


                                    </tr>
                                    </thead>

                                    @foreach ($permissions as $permission)

                                        <tr class="text-center">
                                            <td>{{$permission->module->name}}</td>
                                            <td class="text-center">{{$permission->company->name}}</td>
                                            <td>{{$permission_texts[$permission->permission]}}</td>
                                            <td class="text-center" style="vertical-align: middle;">
                                                <form method="get"
                                                      action="{{route('admin_permission.edit',$permission->id)}}">
                                                    <button type="submit" class="btn btn-xs btn-primary">編輯</button>
                                                    <input type="hidden" value="" id="source_html" name="source_html">
                                                </form>
                                            </td>


                                        </tr>
                                    @endforeach
                                </table>
                            </div>

                            <!-- /.box-body -->
                            <div class="box-footer clearfix">
                                {{ $permissions->appends(request()->input())->links() }}
                            </div>
                        </div>

                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            {{--    </div>--}}
            <!-- /.row -->

        </section>
        <!-- /.content -->
    </div>

    <script>
        function announcement_edit(id) {
            document.getElementById('source_html').value = encodeURIComponent(window.location.href);

        }

        var nodes = document.getElementsByName('source_html');
        for (let i = 0; i < nodes.length; i++) {
            nodes[i].value = (window.location);
        }

    </script>
    <!-- /.content-wrapper -->
@endsection
