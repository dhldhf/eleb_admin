@extends('layout.default')
@section('title','商品分类列表')
@section('content')
    <table class="table table-bordered" id="admins">
        <tr>
            <th>ID</th>
            <th>名称</th>
            <th>邮箱</th>
            <th>操作</th>
        </tr>
        @foreach($admins as $admin)
            <tr data-id="{{ $admin->id }}">
                <td>{{$admin->id}}</td>
                <td>{{$admin->name}}</td>
                <td>{{$admin->email}}</td>
                <td>
                    <a href="{{ route('admins.edit',['admin'=>$admin]) }}" class="btn btn-sm btn-warning">编辑</a>
                    <a href="{{ route('admins.show',['admin'=>$admin]) }}" class="btn btn-sm btn-warning">修改密码</a>

                    <button class="btn btn-danger">删除</button>
                </td>
            </tr>
        @endforeach
    </table>
    <div>{{ $admins->links() }}</div>
    <a href="{{ route('admins.create') }}" class="btn btn-lg btn-info">添加管理员</a>
@stop
@section('js')
    <script type="text/javascript">
        $(function () {
            $("#admins .btn-danger").on('click',function () {
                if(confirm('是否确认删除?')){
                    var tr = $(this).closest('tr');
                    var id = tr.attr('data-id');
                    $.ajax({
                        type: "DELETE",
                        url: "admins/"+id,
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
