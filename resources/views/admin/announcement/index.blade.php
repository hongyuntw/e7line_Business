@extends('admin.layouts.master')

@section('title', '公告列表')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <a href="{{route('admin_announcement.index')}}">公告列表</a>
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-shopping-bag"></i> 公告</a></li>
                {{--                <li class="active">客戶列表</li>--}}
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
                            {{--                            <div class="row">--}}
                            {{--                                <form name="filter_form" action="{{route('mails.index')}}" method="get">--}}
                            {{--                                    --}}
                            {{--                                    <div class="col-md-2 col-3">--}}
                            {{--                                        <label>在職狀態篩選</label>--}}
                            {{--                                        <select name="is_left"--}}
                            {{--                                                class="form-control form-control-sm">--}}
                            {{--                                            @foreach(['-1','0','1'] as $col)--}}
                            {{--                                                <option @if($col==$is_left) selected--}}
                            {{--                                                        @endif value="{{$col}}">{{$status_text[$loop->index]}}</option>--}}
                            {{--                                            @endforeach--}}
                            {{--                                        </select>--}}
                            {{--                                    </div>--}}
                            {{--                                    <div class="col-md-2 col-3">--}}
                            {{--                                        <label>收信狀態篩選</label>--}}
                            {{--                                        <select  name="want_receive_mail"--}}
                            {{--                                                 class="form-control form-control-sm">--}}
                            {{--                                            @foreach(['-1','1','0'] as $col)--}}
                            {{--                                                <option @if($col==$want_receive_mail) selected--}}
                            {{--                                                        @endif value="{{$col}}">@if($col==-1)---@elseif($col==1)是@else否@endif</option>--}}
                            {{--                                            @endforeach--}}
                            {{--                                        </select>--}}
                            {{--                                    </div>--}}
                            {{--                                    <div class="col-md-2 col-3">--}}
                            {{--                                        <label>排序方式</label>--}}
                            {{--                                        <select multiple name="sortBy[]" class="form-control form-control-sm">--}}
                            {{--                                            @foreach(['create_date','name','customer_name','is_left','area','want_receive_mail'] as $col)--}}
                            {{--                                                <option @if(is_array($sortBy))--}}
                            {{--                                                        @if(in_array($col, $sortBy))--}}
                            {{--                                                        selected--}}
                            {{--                                                        @endif--}}
                            {{--                                                        @endif value="{{$col}}">{{$sortBy_text[$loop->index]}}</option>--}}
                            {{--                                            @endforeach--}}
                            {{--                                        </select>--}}
                            {{--                                    </div>--}}
                            {{--                                    <div class="col-md-1 col-3">--}}
                            {{--                                        <label>篩選按鈕</label><br>--}}
                            {{--                                        <button type="submit" class="w-100 btn btn-sm bg-blue">Filter</button>--}}
                            {{--                                    </div>--}}
                            {{--                                </form>--}}
                            {{--                                <div class="col-md-3 col-3">--}}
                            {{--                                    <label>搜尋</label><br>--}}
                            {{--                                    <!-- search form (Optional) -->--}}
                            {{--                                    <form roe="form" action="{{route('mails.index')}}" method="get">--}}
                            {{--                                        <div class="form-inline">--}}
                            {{--                                            <select name="search_type" class="form-group form-control">--}}
                            {{--                                                <option value="1" @if(request()->get('search_type')==1) selected @endif>--}}
                            {{--                                                    姓名--}}
                            {{--                                                </option>--}}
                            {{--                                                <option value="2" @if(request()->get('search_type')==2) selected @endif>--}}
                            {{--                                                    公司(客戶)--}}
                            {{--                                                </option>--}}
                            {{--                                                <option value="3" @if(request()->get('search_type')==3) selected @endif>--}}
                            {{--                                                    地區--}}
                            {{--                                                </option>--}}
                            {{--                                            </select>--}}
                            {{--                                            <br>--}}
                            {{--                                            <div class="inline">--}}
                            {{--                                                <input type="text" name="search_info" class="form-control"--}}
                            {{--                                                       placeholder="Search..." value="@if(request()->get('search_info')) {{request()->get('search_info')}} @endif">--}}
                            {{--                                                <button type="submit" id="search-btn" style="cursor: pointer"--}}
                            {{--                                                        class="btn btn-flat"><i class="fa fa-search"></i>--}}
                            {{--                                                </button>--}}
                            {{--                                            </div>--}}
                            {{--                                        </div>--}}
                            {{--                                        <input hidden name="is_left" value="{{$is_left}}">--}}
                            {{--                                        <input hidden name="want_receive_mail" value="{{$want_receive_mail}}">--}}

                            {{--                                        <select multiple name="sortBy[]" hidden>--}}
                            {{--                                            @if(request()->get('sortBy'))--}}
                            {{--                                                @foreach(request()->get('sortBy') as $col)--}}
                            {{--                                                    <option selected value="{{$col}}"></option>--}}
                            {{--                                                @endforeach--}}
                            {{--                                            @endif--}}
                            {{--                                        </select>--}}
                            {{--                                    </form>--}}
                            {{--                                    <!-- /.search form -->--}}

                            {{--                                </div>--}}
                            {{--                                <div class="col-md-1 col-3">--}}
                            {{--                                    <label>特殊功能</label><br>--}}
                            {{--                                    <a class="btn btn-success btn-sm" href="{{route('mails.export',request()->input())}}">Export</a>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}


                        </div>

                        <!-- /.box-header -->
                        <div class="box-body ">

                            <table class="table table-bordered table-hover" width="100%">
                                <thead style="background-color: lightgray">
                                <tr>
                                    <th class="text-center" style="width:20%">公司名稱</th>
                                    <th class="text-center" style="width:10%">類別</th>
                                    <th class="text-center" style="width:40%">標題</th>
                                    <th class="text-center" style="width:10%">刊登時間</th>
                                    <th class="text-center" style="width:20%">其他</th>


                                </tr>
                                </thead>

                                @foreach ($announcements as $announcement)

                                    <tr class="text-center">
                                        <td>{{$announcement->company->name}}</td>
                                        <td class="text-center">
                                            @if($announcement->type == 0 )
                                                通知
                                            @elseif($announcement->type == 1)
                                                活動
                                            @else
                                                其他
                                            @endif
                                        </td>

                                        <td class="text-center">{{$announcement->title}}</td>
                                        <td>{{date('Y-m-d H:m',strtotime($announcement->create_date))}}</td>
                                        <td class="text-center" style="vertical-align: middle;">
                                            <form method="get"
                                                  action="{{route('admin_announcement.edit',$announcement->id)}}">
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
