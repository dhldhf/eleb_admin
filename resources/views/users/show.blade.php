@extends('layout.default')
@section('title','会员信息列表')
@section('content')
会员名:<div>{{ $user->name }}</div>
电话号码:<div>{{ $user->tel }}</div>
@stop
