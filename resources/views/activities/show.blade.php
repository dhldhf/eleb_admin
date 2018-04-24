@extends('layout.default')
@section('title','活动详情页')
@section('content')
                <div style="text-align: center"><h1>{{ $activity->title }}</h1></div>
                <div>内容:{!!$activity->contents!!}</div>
                <td>活动时间:{{date('Y-m-d',$activity->start_time)}}至{{ date('Y-m-d',$activity->end_time) }}</td>
    @if($activity->end_time < time())
        <h1 style="color: red">活动已结束</h1>
    @endif
@stop