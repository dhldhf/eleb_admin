@extends('layout.default')
@section('title','商家登录页')
@section('content')
    <form method="post" action="{{route('login')}}" enctype="multipart/form-data">
        <div class="form-group">
            <label for="">商家名称</label>
            <input type="text" class="form-control" id="商家名称" placeholder="商家名称" name="name" value="{{old('name')}}">
        </div>
        <div class="form-group">
            <label for="">电话号码</label>
            <input type="number" class="form-control" id="电话号码" placeholder="电话号码" name="phone" value="{{old('phone')}}">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">密码</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="密码" name="password" value="{{old('password')}}">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1">再次确认密码</label>
            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="密码" name="password_confirmation" value="{{old('password_confirmation')}}">
        </div>
        <div class="form-group">
            <label>验证码</label>
            <div class="row">
                <div class="col-sm-3">
                    <input id="captcha" class="form-control" name="captcha" >
                </div>
                <div class="col-sm-6">
                    <img class="thumbnail captcha" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">
                </div>
            </div>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="rememberMe" value="1"> Check me out
            </label>
        </div>
        {{csrf_field()}}
        <button type="submit" class="btn btn-primary btn-block">登录</button>
    </form>
@stop