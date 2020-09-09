@extends('admin.layouts.master')

@section('title', '投票列表')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                <a href="{{route('admin_vote.index')}}">投票列表</a>
                <small></small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-shopping-bag"></i> 投票</a></li>
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
                            <div class="row">
                                <form name="filter_form" action="{{route('admin_vote.index')}}" method="get">

                                    <div class="col-md-4">
                                        <label>From</label>


                                        <input type="date" class="form-control" name="date_from"
                                               value="@if($date_from != null){{($date_from)}}@endif">
                                        <label>To</label>
                                        <input type="date" class="form-control" name="date_to"
                                               value="@if($date_to != null){{$date_to}}@endif">

                                    </div>
                                    <div class="col-md-2">
                                        <label>狀態</label>

                                        <select name="is_active" class="form-control form-control-sm"
                                                id="is_active">
                                            <option value="-1" @if($is_active==-1) selected @endif>All
                                            </option>
                                            <option value="0" @if($is_active==0) selected @endif>關閉</option>
                                            <option value="1" @if($is_active==1) selected @endif>開啟</option>
                                        </select>

                                    </div>
                                    <div class="col-md-2">
                                        <label>排序方式 及 訂單種類</label>
                                        <select name="sortBy" class="form-control form-control-sm">
                                            @foreach(['create_date','deadline'] as $col)
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
                                    <form roe="form" action="{{route('admin_vote.index')}}" method="get">
                                        <div class="form-inline">
                                            <select name="search_type" class="form-group form-control">
                                                <option value="1" @if(request()->get('search_type')==1) selected @endif>
                                                    投票主題
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
                                        <input hidden name="is_active" value="{{$is_active}}">


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
                                    <th class="text-center" style="width:5%">類別</th>
                                    <th class="text-center" style="width:5%">狀態</th>

                                    <th class="text-center" style="width:30%">投票名稱</th>
                                    <th class="text-center" style="width:20%">創立者</th>
                                    <th class="text-center" style="width:10%">刊登時間</th>
                                    <th class="text-center" style="width:10%">截止時間</th>
                                    <th class="text-center" style="width:20%">其他</th>


                                </tr>
                                </thead>

                                @foreach ($votes as $vote)
                                    <tr class="text-center">
                                        <td class="text-center">
                                            @if($vote->type == 0 )
                                                單選
                                            @elseif($vote->type == 1)
                                                多選
                                            @else
                                                其他
                                            @endif
                                        </td>

                                        <td class="text-center">
                                            @if($vote->is_active == 0 )
                                                關閉

                                            @else
                                                正常
                                            @endif
                                        </td>

                                        <td class="text-center">{{$vote->title}}</td>
                                        <td class="text-center">{{$vote->company->name}}/{{$vote->user->name}}</td>
                                        <td>{{date('Y-m-d H:m',strtotime($vote->create_date))}}</td>
                                        <td>{{date('Y-m-d H:m',strtotime($vote->deadline))}}</td>
                                        <td class="text-center" style="vertical-align: middle;">

                                            @if(Auth::user()->level == 2 or Auth::user()->level == 1 or (Auth::user()->level==0 and Auth::user()->id ==$vote->user_id ))

                                                <form method="get"
                                                      action="{{route('admin_vote.edit',$vote->id)}}">
                                                    <button type="submit" class="btn btn-xs btn-primary">編輯</button>
                                                    <input type="hidden" value="" id="source_html" name="source_html">
                                                </form>
                                            @endif
{{--                                            <form method="get"--}}
{{--                                                  action="{{route('admin_vote.vote',$vote->id)}}">--}}
{{--                                                <button type="submit" class="btn btn-xs btn-primary">投票</button>--}}
{{--                                                <input type="hidden" value="" id="source_html" name="source_html">--}}
{{--                                            </form>--}}
                                            <form method="get"
                                                  action="{{route('admin_vote.result',$vote->id)}}">
                                                <button type="submit" class="btn btn-xs btn-primary">結果</button>
                                                <input type="hidden" value="" id="source_html" name="source_html">
                                            </form>
                                        </td>


                                    </tr>
                                @endforeach
                            </table>
                        </div>

                        <!-- /.box-body -->
                        <div class="box-footer clearfix">
                            {{ $votes->appends(request()->input())->links() }}
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
