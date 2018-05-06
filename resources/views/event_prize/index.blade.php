@extends('layout.default')
@section('title','活动列表')
@section('content')
    <table class="table table-bordered" id="event_prize">
        <tr>
            <th>所属活动</th>
            <th>奖品名称</th>
            <th>奖品详情</th>
            <th>中奖商家ID</th>
            <th>操作</th>
        </tr>
        @foreach($event_prizes as $event_prize)
            <tr data-id="{{ $event_prize->id }}">
                <td>{{$event_prize->events->title}}</td>
                <td>{{$event_prize->name}}</td>
                <td>{{$event_prize->description}}</td>
                <td>{{$event_prize->member_id}}</td>
                <td>
                    <a href="{{ route('event_prize.edit',['event_prize'=>$event_prize]) }}" class="btn btn-warning">编辑</a>
                    <button class="btn btn-danger">删除</button>
                </td>
            </tr>
        @endforeach
    </table>
    <a href="{{ route('event_prize.create') }}" class="btn btn-primary">添加奖品</a>
@stop
@section('js')
    <script type="text/javascript">
        $(function () {
            $("#event_prize .btn-danger").on('click',function () {
                if(confirm('是否确认删除?')){
                    var tr = $(this).closest('tr');
                    var id = tr.attr('data-id');
                    $.ajax({
                        type: "DELETE",
                        url: "event_prize/"+id,
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