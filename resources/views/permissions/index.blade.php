@extends('layout.default')
@section('title','权限列表')
@section('content')
    <table class="table table-bordered" id="permissions">
        <tr>
            <th>权限名称</th>
            <th>显示名称</th>
            <th>描述</th>
            <th>操作</th>
        </tr>
        @foreach($permissions as $permission)
            <tr data-id="{{ $permission->id }}">
                <td>{{$permission->name}}</td>
                <td>{{$permission->display_name}}</td>
                <td>{{$permission->description}}</td>
                <td>
                    <a href="{{ route('permissions.edit',['permission'=>$permission]) }}" class="btn btn-sm btn-warning">编辑</a>
                    <a href="{{ route('permissions.show',['permission'=>$permission]) }}" class="btn btn-sm btn-primary">查看</a>
                    <button class="btn btn-danger">删除</button>
                </td>
            </tr>
        @endforeach
    </table>
    <div>{{ $permissions->links() }}</div>
    <a href="{{ route('permissions.create') }}" class="btn btn-lg btn-info">添加权限</a>
@stop
@section('js')
    <script type="text/javascript">
        $(function () {
            $("#permissions .btn-danger").on('click',function () {
                if(confirm('是否确认删除?')){
                    var tr = $(this).closest('tr');
                    var id = tr.attr('data-id');
                    $.ajax({
                        type: "DELETE",
                        url: "permissions/"+id,
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