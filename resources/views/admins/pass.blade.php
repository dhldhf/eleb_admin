@extends('layout.default')
@section('title','修改密码')
@section('content')
    <form method="post" action="{{route('add_pass',['admin'=>$admin])}}">
            <input type="hidden" class="form-control" id="旧密码" placeholder="旧密码" name="name" value="{{ $admin->name }}">
        <div class="form-group">
            <label for="">旧密码</label>
            <input type="password" class="form-control" id="旧密码" placeholder="旧密码" name="old_password" value="{{old('old_password')}}">
        </div>
        <div class="form-group">
            <label for="">新密码</label>
            <input type="password" class="form-control" id="新密码" placeholder="新密码" name="password" value="{{old('password')}}">
        </div>
        <div class="form-group">
            <label for="">再次确认密码</label>
            <input type="password" class="form-control" id="密码" placeholder="密码" name="password_confirmation" value="{{old('password_confirmation')}}">
        </div>
        {{csrf_field()}}
        <button type="submit" class="btn btn-success btn-block">提交</button>
    </form>
@stop