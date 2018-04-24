@extends('layout.default')
@section('title','添加活动')
@section('content')
    <form method="post" action="{{route('activities.store')}}">
        <div class="form-group">
            <label for="">标题</label>
            <input type="text" class="form-control" id="标题" placeholder="标题" name="title" value="{{old('title')}}">
        </div>
        <div class="form-group">
            <label for="">活动开启时间</label>
            <input type="date" class="form-control" name="start_time" value="{{old('start_time')}}">
        </div>
        <div class="form-group">
            <label for="">活动结束时间</label>
            <input type="date" class="form-control" name="end_time" value="{{old('end_time')}}">
        </div>
        <div>
            <!-- 加载编辑器的容器 -->
            <script id="container" name="contents" type="text/plain"></script>
            <!-- 配置文件 -->
            <script type="text/javascript" src="/ueditor/ueditor.config.js"></script>
            <!-- 编辑器源码文件 -->
            <script type="text/javascript" src="/ueditor/ueditor.all.js"></script>
            <!-- 实例化编辑器 -->
            <script type="text/javascript">
                var ue = UE.getEditor('container');
            </script>
        </div>
        {{csrf_field()}}
        <button type="submit" class="btn btn-success btn-block">提交</button>
    </form>
@stop


