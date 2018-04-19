@extends('layout.default')
@section('title','商家注册页')
@section('content')
    <form method="post" action="{{route('businesses.store')}}" enctype="multipart/form-data">
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
        <div class="form-group">
            <label for="">商家图片</label>
            <input type="file" name="logo">
        </div>
        {{csrf_field()}}
        <button type="submit" class="btn btn-primary btn-block">提交</button>
    </form>
    @stop