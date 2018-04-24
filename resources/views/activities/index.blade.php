@extends('layout.default')
@section('title','活动列表')
@section('content')
    <table class="table table-bordered" id="activities">
        <tr>
            <th>ID</th>
            <th>活动标题</th>
            <th>活动内容</th>
            <th>活动开启时间</th>
            <th>活动结束时间</th>
            <th>操作</th>
        </tr>
        @foreach($activities as $activity)
            <tr data-id="{{ $activity->id }}">
                <td>{{$activity->id}}</td>
                <td>{{ $activity->title }}</td>
                <td>{!! mb_substr($activity->contents,0,20)!!}</td>
                <td>{{date('Y-m-d',$activity->start_time)}}</td>
                <td>{{date('Y-m-d',$activity->end_time)}}</td>
                <td>
                    <a href="{{ route('activities.edit',['activity'=>$activity]) }}" class="btn btn-sm btn-warning">编辑</a>
                    <a href="{{ route('activities.show',['activity'=>$activity]) }}" class="btn btn-sm btn-primary">活动详情</a>

                    <button class="btn btn-danger">删除</button>
                </td>
            </tr>
        @endforeach
    </table>
    <div>{{ $activities->links() }}</div>
    <a href="{{ route('activities.create') }}" class="btn btn-lg btn-info">添加活动</a>
@stop
@section('js')
    <script type="text/javascript">
        $(function () {
            $("#activities .btn-danger").on('click',function () {
                if(confirm('是否确认删除?')){
                    var tr = $(this).closest('tr');
                    var id = tr.attr('data-id');
                    $.ajax({
                        type: "DELETE",
                        url: "activities/"+id,
                        data: "_token={{ csrf_token() }}",
                        success: function(msg){
                            tr.fadeOut();
                        }
                    });
                }

            });
        });
    </script>
@stop
