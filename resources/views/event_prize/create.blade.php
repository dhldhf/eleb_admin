@extends('layout.default')
@section('title','奖品添加页')
@section('content')
    <form method="post" action="{{route('event_prize.store')}}" enctype="multipart/form-data">
        <div class="form-group">
            <label for="">奖品名称</label>
            <input type="text" class="form-control" id="奖品名称" placeholder="奖品名称" name="name" value="{{old('name')}}">
        </div>
        <div class="form-group">
            <label for="">所属活动</label>
            <select name="events_id" id="" class="form-control">
                @foreach($events as $event)
                    <option value="{{ $event->id }}">{{ $event->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="">详情</label>
            <input type="text" class="form-control" id="详情" placeholder="详情" name="description" value="{{old('description')}}">
        </div>
        {{csrf_field()}}
        <button type="submit" class="btn btn-primary btn-block">提交</button>
    </form>
@stop
