@extends('layout.default')
@section('title','会员列表')
@section('content')
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>会员名</th>
            <th>操作</th>
        </tr>
        @foreach($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>
                    <a href="{{ route('users.edit',['user'=>$user]) }}" class="btn btn-sm btn-warning">禁用该会员</a>
                    <a href="{{ route('users.show',['user'=>$user]) }}" class="btn btn-sm btn-primary">查看</a>
                </td>
            </tr>
        @endforeach
    </table>
    <div>{{ $users->links() }}</div>
@stop

