@extends('admin.layouts.master')

@section('title', '規定列表')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <a href="{{route('admin_info.index')}}">規定列表</a>
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-shopping-bag"></i> 規定</a></li>
                <li class="active">規定列表</li>
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
                                <form name="filter_form" action="{{route('admin_info.index')}}" method="get">
                                    {{--                                    <div class="col-md-2">--}}
                                    {{--                                        <label>公告類型</label>--}}
                                    {{--                                        <select name="type_filter" class="form-control form-control-sm">--}}
                                    {{--                                            <option value="-1" @if(-1==$type_filter) selected--}}
                                    {{--                                                    @endif>All--}}
                                    {{--                                            </option>--}}
                                    {{--                                            <option value="0" @if(0==$type_filter) selected @endif>通知</option>--}}
                                    {{--                                            <option value="1" @if(1==$type_filter) selected @endif>活動</option>--}}

                                    {{--                                        </select>--}}

                                    {{--                                    </div>--}}

                                    <div class="col-md-4">
                                        <label>From</label>


                                        <input type="date" class="form-control" name="date_from"
                                               value="@if($date_from != null){{($date_from)}}@endif">
                                        <label>To</label>
                                        <input type="date" class="form-control" name="date_to"
                                               value="@if($date_to != null){{$date_to}}@endif">

                                    </div>
                                    <div class="col-md-2">
                                        <label>排序方式 </label>
                                        <select name="sortBy" class="form-control form-control-sm">
                                            @foreach(['create_date'] as $col)
                                                <option @if($sortBy == $col) selected
                                                        @endif value="{{$col}}">{{$sortBy_text[$loop->index]}}</option>
                                            @endforeach
                                        </select>
                                        <button type="submit" class=" btn btn-sm bg-blue" style="width: 100%">篩選
                                        </button>
                                    </div>

                                </form>
                                <div class="col-md-3 col-3">
                                    <label>搜尋</label><br>
                                    <!-- search form (Optional) -->
                                    <form roe="form" action="{{route('admin_info.index')}}" method="get">
                                        <div class="form-inline">
                                            <select name="search_type" class="form-group form-control">
                                                <option value="1" @if(request()->get('search_type')==1) selected @endif>
                                                    標題
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
                                        <input hidden name="date_from" value="{{$date_from}}">
                                        <input hidden name="date_to" value="{{$date_to}}">
                                        <input hidden name="sortBy" value="{{$sortBy}}">


                                    </form>
                                    <!-- /.search form -->

                                </div>

                            </div>


                        </div>

                        <!-- /.box-header -->
                        <div class="box-body ">

                            <table class="table table-bordered table-hover" width="100%">
                                <thead style="background-color: lightgray">
                                <tr>
                                    <th class="text-center" style="width:20%">公司名稱</th>
                                    {{--                                    <th class="text-center" style="width:10%">類別</th>--}}
                                    <th class="text-center" style="width:40%">標題</th>
                                    <th class="text-center" style="width:10%">刊登時間</th>
                                    <th class="text-center" style="width:20%">其他</th>


                                </tr>
                                </thead>

                                @foreach ($announcements as $announcement)

                                    <tr class="text-center">
                                        <td>{{$announcement->company->name}}</td>


                                        <td class="text-center">{{$announcement->title}}</td>
                                        <td>{{date('Y-m-d H:m',strtotime($announcement->create_date))}}</td>
                                        <td class="text-center" style="vertical-align: middle;">
                                            @if(Auth::user()->level == 2 or Auth::user()->level == 1 or (Auth::user()->level==0 and Auth::user()->id ==$announcement->user_id ))

                                                <form method="get"
                                                      action="{{route('admin_info.edit',$announcement->id)}}">
                                                    <button type="submit" class="btn btn-xs btn-primary">編輯</button>
                                                    <input type="hidden" value="" id="source_html" name="source_html">
                                                </form>
                                            @endif
                                        </td>


                                    </tr>
                                @endforeach
                            </table>
                        </div>

                        <!-- /.box-body -->
                        <div class="box-footer clearfix">
                            {{ $announcements->appends(request()->input())->links() }}
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
