@extends('layout.default')
@section('title','菜单列表')
@section('content')
    <table class="table table-bordered" id="menus">
        <tr>
            <th>菜单名称</th>
            <th>菜单地址</th>
            <th>排序</th>
            <th>操作</th>
        </tr>
        @foreach($categoryList_new as $menu)
            <tr data-id="{{ $menu->id }}">
                <td>{{$menu->name_txt}}</td>
                <td>{{$menu->address}}</td>
                <td>{{$menu->sort}}</td>
                <td>
                    <a href="{{ route('menus.edit',['menu'=>$menu]) }}" class="btn btn-warning">编辑</a>
                    <button class="btn btn-danger">删除</button>
                </td>
            </tr>
        @endforeach
    </table>
@stop
@section('js')
    <script type="text/javascript">
        $(function () {
            $("#menus .btn-danger").on('click',function () {
                if(confirm('是否确认删除?')){
                    var tr = $(this).closest('tr');
                    var id = tr.attr('data-id');
                    $.ajax({
                        type: "DELETE",
                        url: "menus/"+id,
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