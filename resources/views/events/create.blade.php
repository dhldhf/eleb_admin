@extends('layout.default')
@section('title','活动添加页')
@section('content')
    <form method="post" action="{{route('events.store')}}" enctype="multipart/form-data">
        <div class="form-group">
            <label for="">活动名称</label>
            <input type="text" class="form-control" id="活动名称" placeholder="活动名称" name="title" value="{{old('title')}}">
        </div>
        <div class="form-group">
            <label for="">活动详情</label>
            <input type="text" class="form-control" id="活动详情" placeholder="活动详情" name="contents" value="{{old('contents')}}">
        </div>

        <div class="form-group">
            <label for="">报名开始时间</label>
            <input type="date" class="form-control" id="报名开始时间" placeholder="报名开始时间" name="signup_start" value="{{old('signup_start')}}">
        </div>
        <div class="form-group">
            <label for="">报名结束时间</label>
            <input type="date" class="form-control" id="报名结束时间" placeholder="报名结束时间" name="signup_end" value="{{old('signup_end')}}">
        </div>
        <div class="form-group">
            <label for="">开奖日期</label>
            <input type="date" class="form-control" id="开奖日期" placeholder="开奖日期" name="prize_date" value="{{old('prize_date')}}">
        </div>
        <div class="form-group">
            <label for="">报名人数限制</label>
            <input type="number" class="form-control" id="报名人数限制" placeholder="报名人数限制" name="signup_num" value="{{old('signup_num')}}">
        </div>
        {{--<div class="form-group">--}}
            {{--<label for="">--}}
            {{--<input type="checkbox" name="is_prize" value="1"> 是否已开奖--}}
            {{--</label>--}}
        {{--</div>--}}
        {{csrf_field()}}
        <button type="submit" class="btn btn-primary btn-block">提交</button>
    </form>
@stop
