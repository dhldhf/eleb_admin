@extends('layout.default')
@section('title','活动奖品列表')
@section('content')
<div>活动标题: {{$event->title}}</div>
<div>活动详情: {{$event->content}}</div>
<div>开始报名时间: {{$event->signup_start}}</div>
<div>报名结束时间: {{$event->signup_end}}</div>
<div>开奖日期: {{$event->prize_date}}</div>
<div>限制人数: {{$event->signup_num}}</div>
<div>是否已开奖: {{$event->is_prize==0?'未开奖':'已开奖'}}</div>
@foreach($event_prizes as $event_prize)
    <div>奖品名称: {{ $event_prize->name }}</div>
    <div>奖品描述: {{ $event_prize->description }}</div>
    @endforeach
@stop