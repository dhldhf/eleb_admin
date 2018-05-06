@extends('layout.default')
@section('title','活动修改页')
@section('content')
    <form method="post" action="{{route('events.update',['event'=>$event])}}" enctype="multipart/form-data">
        <div class="form-group">
            <label for="">活动名称</label>
            <input type="text" class="form-control" id="活动名称" placeholder="活动名称" name="title" value="{{$event->title}}">
        </div>
        <div class="form-group">
            <label for="">活动详情</label>
            <input type="text" class="form-control" id="活动详情" placeholder="活动详情" name="contents" value="{{$event->content}}">
        </div>

        <div class="form-group">
            <label for="">报名开始时间</label>
            <input type="date" class="form-control" id="报名开始时间" placeholder="报名开始时间" name="signup_start" value="{{$event->signup_start}}">
        </div>
        <div class="form-group">
            <label for="">报名结束时间</label>
            <input type="date" class="form-control" id="报名结束时间" placeholder="报名结束时间" name="signup_end" value="{{$event->signup_end}}">
        </div>
        <div class="form-group">
            <label for="">开奖日期</label>
            <input type="date" class="form-control" id="开奖日期" placeholder="开奖日期" name="prize_date" value="{{$event->prize_date}}">
        </div>
        <div class="form-group">
            <label for="">报名人数限制</label>
            <input type="number" class="form-control" id="报名人数限制" placeholder="报名人数限制" name="signup_num" value="{{$event->signup_num}}">
        </div>
        {{csrf_field()}}
        {{ method_field('put') }}
        <button type="submit" class="btn btn-primary btn-block">提交</button>
    </form>
@stop
