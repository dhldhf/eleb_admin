@extends('layout.default')
@section('title','奖品修改页')
@section('content')
    <form method="post" action="{{route('event_prize.update',['event_prize'=>$event_prize])}}" enctype="multipart/form-data">
        <div class="form-group">
            <label for="">奖品名称</label>
            <input type="text" class="form-control" id="奖品名称" placeholder="奖品名称" name="name" value="{{$event_prize->name}}">
        </div>
        <div class="form-group">
            <label for="">所属活动</label>
            <select name="events_id" id="" class="form-control">
                @foreach($events as $event)
                    <option value="{{ $event->id }}" {{ $event->id==$event_prize->events_id?'selected':$event->id}}>{{ $event->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="">详情</label>
            <input type="text" class="form-control" id="详情" placeholder="详情" name="description" value="{{$event_prize->description}}">
        </div>
        {{csrf_field()}}
        {{ method_field('put') }}
        <button type="submit" class="btn btn-primary btn-block">提交</button>
    </form>
@stop
