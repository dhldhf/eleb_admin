@extends('layout.default')
@section('title','添加管理员')
@section('content')
    <form method="post" action="{{route('admins.store')}}">
        <div class="form-group">
            <label for="">管理员名称</label>
            <input type="text" class="form-control" id="管理员名称" placeholder="管理员名称" name="name" value="{{old('name')}}">
        </div>
        <div class="checkbox">
            <label for="">选择角色</label>
            <br/>
            <label for="">
                @foreach($roles as $role)
                    <input type="checkbox" name="roles[]" value="{{ $role->id }}">{{ $role->description }}&emsp;&emsp;
                @endforeach
            </label>
        </div>
        <div class="form-group">
            <label for="">密码</label>
            <input type="password" class="form-control" id="密码" placeholder="密码" name="password" value="{{old('password')}}">
        </div>
        <div class="form-group">
            <label for="">再次确认密码</label>
            <input type="password" class="form-control" id="密码" placeholder="密码" name="password_confirmation" value="{{old('password_confirmation')}}">
        </div>
        <div class="form-group">
            <label for="">邮箱</label>
            <input type="text" class="form-control" id="邮箱" placeholder="邮箱" name="email" value="{{old('email')}}">
        </div>
        {{csrf_field()}}
        <button type="submit" class="btn btn-success btn-block">提交</button>
    </form>
@stop
