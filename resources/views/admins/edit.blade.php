@extends('layout.default')
@section('title','修改管理员页')
@section('content')
    <form method="post" action="{{route('admins.update',['admin'=>$admin])}}">
        <div class="form-group">
            <label for="">管理员名称</label>
            <input type="text" class="form-control" id="管理员名称" placeholder="管理员名称" name="name" value="{{ $admin->name }}">
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
        {{--<div class="form-group">

            <select name="roles" id="" class="form-control">
                @foreach($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>--}}
        <div class="form-group">
            <label for="">密码</label>
            <input type="password" class="form-control" id="密码" placeholder="密码" name="password">
        </div>
        <div class="form-group">
            <label for="">再次确认密码</label>
            <input type="password" class="form-control" id="密码" placeholder="密码" name="password_confirmation">
        </div>
        <div class="form-group">
            <label for="">邮箱</label>
            <input type="text" class="form-control" id="邮箱" placeholder="邮箱" name="email" value="{{ $admin->email }}">
        </div>
        {{csrf_field()}}
        {{ method_field('put') }}
        <button type="submit" class="btn btn-success btn-block">提交</button>
    </form>
@stop

