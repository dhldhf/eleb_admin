@extends('layout.default')
@section('title','修改权限')
@section('content')
    <form method="post" action="{{route('permissions.update',['permission'=>$permission])}}" enctype="multipart/form-data">
        <div class="form-group">
            <label for="">权限名称</label>
            <input type="text" class="form-control" id="权限名称" placeholder="权限名称" name="name" value="{{ $permission->name }}">
        </div>
        <div class="form-group">
            <label for="">显示名称</label>
            <input type="text" class="form-control" id="显示名称" placeholder="显示名称" name="display_name" value="{{ $permission->display_name }}">
        </div>
        <div class="form-group">
            <label for="">描述</label>
            <input type="text" class="form-control" id="描述" placeholder="描述" name="description" value="{{ $permission->description }}">
        </div>
        {{csrf_field()}}
        {{ method_field('put') }}
        <button type="submit" class="btn btn-primary btn-block">提交</button>
    </form>
@stop
