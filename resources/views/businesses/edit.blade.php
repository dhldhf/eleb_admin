@extends('layout.default')
@section('title','商家修改页')
@section('content')
    <form method="post" action="{{route('businesses.update',['business'=>$business])}}" enctype="multipart/form-data">
        <div class="form-group">
            <label for="">商家名称</label>
            <input type="text" class="form-control" id="商家名称" placeholder="商家名称" name="name" value="{{ $business->name }}">
        </div>
        <div class="form-group">
            <label for="">电话号码</label>
            <input type="number" class="form-control" id="电话号码" placeholder="电话号码" name="phone" value="{{ $business->phone }}">
        </div>
        <div class="form-group">
            <label for="">邮箱</label>
            <input type="text" class="form-control" id="邮箱" placeholder="邮箱" name="email" value="{{$business->email}}">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">密码</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="密码" name="password" value="{{old('password')}}">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">再次确认密码</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="密码" name="password_confirmation" value="{{old('password_confirmation')}}">
        </div>
        <div class="form-group">
            <label for="">商家图片</label>
            <input type="file" name="logo">
        </div>
        {{csrf_field()}}
        {{ method_field('put') }}
        <button type="submit" class="btn btn-primary btn-block">提交</button>
    </form>
@stop
