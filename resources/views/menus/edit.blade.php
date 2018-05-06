@extends('layout.default')
@section('title','菜单添加页')
@section('content')
    <form method="post" action="{{route('menus.update',['menu'=>$menu])}}" enctype="multipart/form-data">
        <div class="form-group">
            <label for="">菜单名称</label>
            <input type="text" class="form-control" id="菜单名称" placeholder="菜单名称" name="name" value="{{ $menu->name }}">
        </div>
        <div class="form-group">
            <label for="">上级菜单</label>
            <select name="parent_id" id="" class="form-control">
                <option value="">=请选择上级菜单=</option>
                <option value="0" {{ $menu->parent_id==0?'selected':$menu->parent_id }}>顶级菜单</option>
                @foreach($menus as $men)
                    <option value="{{ $men->id }}" {{ $men->id==$menu->parent_id?'selected':$men->id }}>{{ $men->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="">地址</label>
            <input type="text" class="form-control" id="地址" placeholder="地址" name="address" value="{{ $menu->address }}">
        </div>
        <div class="form-group">
            <label for="">排序</label>
            <input type="text" class="form-control" id="排序" placeholder="排序" name="sort" value="{{ $menu->sort }}">
        </div>
        {{csrf_field()}}
        {{ method_field('put') }}
        <button type="submit" class="btn btn-primary btn-block">提交</button>
    </form>
@stop
