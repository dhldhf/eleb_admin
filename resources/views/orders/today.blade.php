@extends('layout.default')
@section('title','订单页')
@section('content')
    <table class="table table-bordered">
        @if($juti_num==0)
            <tr>
                <th>今天订单</th>
                <th>这月订单</th>
                <th>累计订单</th>
            </tr>
            <tr>
                <td>{{ $num }}</td>
                <td>{{ $num1 }}</td>
                <td>{{ $all }}</td>
            </tr>

        @else
            <tr>
                <th>指定订单</th>
            </tr>
            <tr>
                <td>{{ $juti_num }}</td>
            </tr>
        @endif
        <form method="get" action="{{ route('today') }}">
            <input type="date" name="order_birth_time">至<input type="date" name="order_birth_time1"><input type="submit" value="查询">
        </form>
    </table>
@stop
