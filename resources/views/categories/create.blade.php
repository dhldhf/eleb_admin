@extends('layout.default')
@section('title','添加商品分类页')
@section('content')
    <form method="post" action="{{route('categories.store')}}" enctype="multipart/form-data">
        <div class="form-group">
            <label for="">分类名称</label>
            <input type="text" class="form-control" id="分类" placeholder="分类" name="name" value="{{old('name')}}">
        </div>
        <div class="form-group">
            <label for="">分类商品图片</label>
            <input type="file" name="logo">
        </div>
        {{csrf_field()}}
        <button type="submit" class="btn btn-primary btn-block">提交</button>
    </form>
@stop
