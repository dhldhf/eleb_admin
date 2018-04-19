@extends('layout.default')
@section('title','修改商品分类页')
@section('content')
    <form method="post" action="{{route('categories.update',['category'=>$category])}}" enctype="multipart/form-data">
        <div class="form-group">
            <label for="">分类名称</label>
            <input type="text" class="form-control" id="分类" placeholder="分类" name="name" value="{{ $category->name }}">
        </div>
        <div class="form-group">
            <label for="">分类商品图片</label>
            <img src="{{ Storage::url($category->logo) }}" alt="">
            <input type="file" name="logo">
        </div>
        {{csrf_field()}}
        {{ method_field('put') }}
        <button type="submit" class="btn btn-primary btn-block">修改</button>
    </form>
@stop

