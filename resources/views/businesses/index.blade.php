@extends('layout.default')
@section('title','商家信息列表')
@section('content')
    <table class="table table-bordered" id="businesses">
        <tr>
            <th>ID</th>
            <th>商家名称</th>
            <th>商家图片</th>
            <th>电话号码</th>
            <th>审核是否通过</th>
            <th>操作</th>
        </tr>
        @foreach($businesses as $business)
            <tr data-id="{{ $business->id }}">
                <td>{{$business->id}}</td>
                <td>{{$business->name}}</td>
                <td><img src="{{ Storage::url($business->logo)}}" alt="" width="100px" height="100px"></td>
                <td>{{$business->phone}}</td>
                <td>{{$business->is_review==0?'未通过':'通过'}}</td>
                <td>
                    <a href="{{ route('businesses.edit',['business'=>$business]) }}" class="btn btn-sm btn-warning">编辑</a>
                    <a href="{{ route('businesses.show',['business'=>$business]) }}" class="btn btn-sm btn-primary">查看</a>
                    @if($business->is_review==0)<a href="{{ route('review',['business'=>$business]) }}" class="btn btn-sm btn-primary">审核</a>@endif
                    <button class="btn btn-danger">删除</button>
                </td>
            </tr>
        @endforeach
    </table>
    <div>{{ $businesses->links() }}</div>
    <a href="{{ route('businesses.create') }}" class="btn btn-lg btn-info">商家注册</a>
@stop
@section('js')
    <script type="text/javascript">
        $(function () {
            $("#businesses .btn-danger").on('click',function () {
                if(confirm('是否确认删除?')){
                    var tr = $(this).closest('tr');
                    var id = tr.attr('data-id');
                    $.ajax({
                        type: "DELETE",
                        url: "businesses/"+id,
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

