@extends('layout.default')
@section('title','角色列表')
@section('content')
    <table class="table table-bordered" id="roles">
        <tr>
            <th>角色名称</th>
            <th>显示名称</th>
            <th>描述</th>
            <th>操作</th>
        </tr>
        @foreach($roles as $role)
            <tr data-id="{{ $role->id }}">
                <td>{{$role->name}}</td>
                <td>{{$role->display_name}}</td>
                <td>{{$role->description}}</td>
                <td>
                    <a href="{{ route('roles.edit',['role'=>$role]) }}" class="btn btn-sm btn-warning">编辑</a>
                    <a href="{{ route('roles.show',['role'=>$role]) }}" class="btn btn-sm btn-primary">查看</a>
                    <button class="btn btn-danger">删除</button>
                </td>
            </tr>
        @endforeach
    </table>
    <div>{{ $roles->links() }}</div>
    <a href="{{ route('roles.create') }}" class="btn btn-lg btn-info">添加角色</a>
@stop
@section('js')
    <script type="text/javascript">
        $(function () {
            $("#roles .btn-danger").on('click',function () {
                if(confirm('是否确认删除?')){
                    var tr = $(this).closest('tr');
                    var id = tr.attr('data-id');
                    $.ajax({
                        type: "DELETE",
                        url: "roles/"+id,
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