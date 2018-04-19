@extends('layout.default')
@section('title','商品分类列表')
@section('content')
    <table class="table table-bordered" id="categories">
        <tr>
            <th>ID</th>
            <th>分类名称</th>
            <th>分类图片</th>
            <th>操作</th>
        </tr>
        @foreach($categories as $category)
            <tr data-id="{{ $category->id }}">
                <td>{{$category->id}}</td>
                <td>{{$category->name}}</td>
                <td><img src="{{ Storage::url($category->logo)}}" alt="" width="100px" height="100px"></td>
                <td>
                    <a href="{{ route('categories.edit',['category'=>$category]) }}" class="btn btn-sm btn-warning">编辑</a>
                    <a href="{{ route('categories.show',['category'=>$category]) }}" class="btn btn-sm btn-primary">查看</a>
                    <button class="btn btn-danger">删除</button>
                </td>
            </tr>
        @endforeach
    </table>
    <div>{{ $categories->links() }}</div>
    <a href="{{ route('categories.create') }}" class="btn btn-lg btn-info">添加商品分类</a>
@stop
@section('js')
    <script type="text/javascript">
        $(function () {
            $("#categories .btn-danger").on('click',function () {
                if(confirm('是否确认删除?')){
                    var tr = $(this).closest('tr');
                    var id = tr.attr('data-id');
                    $.ajax({
                        type: "DELETE",
                        url: "categories/"+id,
                        data: "_token={{ csrf_token() }}",
                        success: function(msg){
                            tr.fadeOut();
                        }
                    });
                }

            });
        });
    </script>
@stop
