@extends('layout.default')
@section('title','菜单添加页')
@section('content')
    <form method="post" action="{{route('menus.store')}}" enctype="multipart/form-data">
        <div class="form-group">
            <label for="">菜单名称</label>
            <input type="text" class="form-control" id="菜单名称" placeholder="菜单名称" name="name" value="{{old('name')}}">
        </div>
        <div class="form-group">
            <label for="">上级菜单</label>
            <select name="parent_id" id="" class="form-control">
                <option value="">=请选择上级菜单=</option>
                <option value="0">顶级菜单</option>
                @foreach($menus as $menu)
                    <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="">地址</label>
            <input type="text" class="form-control" id="地址" placeholder="地址" name="address" value="{{old('address')}}">
        </div>
        <div class="form-group">
            <label for="">排序</label>
            <input type="text" class="form-control" id="排序" placeholder="排序" name="sort" value="{{old('sort')}}">
        </div>
        {{csrf_field()}}
        <button type="submit" class="btn btn-primary btn-block">提交</button>
    </form>
@stop
