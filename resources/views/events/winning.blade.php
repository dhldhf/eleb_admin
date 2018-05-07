@extends('layout.default')
@section('title','活动奖品列表')
@section('content')
@foreach($event_prizes as $event_prize)
    <div>奖品: {{ $event_prize->name }}</div>
    @foreach($event_prize->bu as $bu)
    <div>所属商家: {{ $bu->name }}</div>
        @endforeach
@endforeach
@stop
