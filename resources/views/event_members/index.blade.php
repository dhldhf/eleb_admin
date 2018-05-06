@extends('layout.default')
@section('title','报名列表')
@section('content')
    <table class="table table-bordered">
        <tr>
            <th>活动名称</th>
            <th>商家</th>
        </tr>
        @foreach($event_members as $event_member)
            <tr>
                <td>{{$event_member->events->title}}</td>
                <td>{{$event_member->businesses->name}}</td>
            </tr>
        @endforeach
    </table>
@stop
