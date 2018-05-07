@extends('layout.default')
@section('title','活动列表')
@section('content')
    <table class="table table-bordered" id="events">
        <tr>
            <th>活动名称</th>
            <th>详情</th>
            <th>报名开始时间</th>
            <th>报名结束时间</th>
            <th>开奖日期</th>
            <th>报名人数限制</th>
            <th>是否已开奖</th>
            <th>操作</th>
        </tr>
        @foreach($events as $event)
            <tr data-id="{{ $event->id }}">
                <td>{{$event->title}}</td>
                <td>{{$event->content}}</td>
                <td>{{$event->signup_start}}</td>
                <td>{{$event->signup_end}}</td>
                <td>{{$event->prize_date}}</td>
                <td>{{$event->signup_num}}</td>
                <td>{{$event->is_prize==0?'未开奖':'已开奖'}}</td>
                <td>
                    <a href="{{ route('events.edit',['event'=>$event]) }}" class="btn btn-warning">编辑</a>
                    <a href="{{ route('events.show',['event'=>$event]) }}" class="btn btn-primary">查看活动及奖品</a>
                    <a href="{{ route('winning',['event'=>$event]) }}" class="btn btn-primary">查看活动中奖详情</a>
                    @if($event->is_prize==0)
                        <a href="{{ route('lottery',['event'=>$event]) }}" class="btn btn-success">开始抽奖</a>
                @endif
                    <button class="btn btn-danger">删除</button>
                </td>
            </tr>
        @endforeach
    </table>
    <a href="{{ route('events.create') }}" class="btn btn-primary">添加活动</a>
    <a href="{{ route('event_members.index') }}" class="btn btn-primary">查看报名商家</a>
@stop
@section('js')
    <script type="text/javascript">
        $(function () {
            $("#events .btn-danger").on('click',function () {
                if(confirm('是否确认删除?')){
                    var tr = $(this).closest('tr');
                    var id = tr.attr('data-id');
                    $.ajax({
                        type: "DELETE",
                        url: "events/"+id,
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