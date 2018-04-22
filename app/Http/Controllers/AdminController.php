<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'except' => [ 'create', 'store']
        ]);

//        $this->middleware('guest', [
////            'only' => ['create']
//        ]);
    }
    public function index()
    {
       $admins =  Admin::paginate(3);
        return view('admins.index',compact('admins'));
    }

    public function create()
    {
        return view('admins.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,
            [
            'name'=>'required',
            'password'=>'required|min:3|confirmed',
            'email'=>'required|email|unique:admins',
        ],
            [
            'name.required'=>'名称不能为空',
            'password.required'=>'密码不能为空',
            'password.min'=>'密码不能小于三位',
            'password.confirmed'=>'两次输入的密码不一致',
            'email.required'=>'邮箱不能为空',
            'email.email'=>'邮箱格式不正确',
            'email.unique'=>'邮箱已存在',
            ]);
        Admin::create([
            'name'=>$request->name,
            'password'=>bcrypt($request->password),
            'email'=>$request->email,
        ]);
        session()->flash('success','添加成功');
        return redirect()->route('admins.index');
    }

    public function edit(Admin $admin)
    {
        return view('admins.edit',compact('admin'));
    }

    public function update(Request $request,Admin $admin)
    {
//        var_dump($request->password,$request->password_confirmation,$request->email);die;
        $this->validate($request,
            [
                'name'=>'required',
                'password'=>'required|min:3|confirmed',
                'email'=>[
                    'required',
                    'email',
                Rule::unique('admins')->ignore($admin->id),]
            ],
            [
                'name.required'=>'名称不能为空',
                'password.required'=>'密码不能为空',
                'password.min'=>'密码不能小于三位',
                'password.confirmed'=>'两次输入的密码不一致',
                'email.required'=>'邮箱不能为空',
                'email.email'=>'邮箱格式不正确',
                'email.unique'=>'邮箱已存在',
            ]);
        $admin->update(
            [
            'name'=>$request->name,
            'password'=>bcrypt($request->password),
            'email'=>$request->email,
        ]);
        session()->flash('success','修改成功');
        return redirect()->route('admins.index');
    }

    public function destroy(Admin $admin)
    {
        $admin->delete();
    }

    public function show(Admin $admin)
    {
        return view('admins.pass',compact('admin'));
    }

    public function add_pass(Request $request,Admin $admin)
    {
        $this->validate($request,
            [
                'old_password'=>'required',
                'password'=>'required|min:3|confirmed',
            ],
            [
                'old_password.required'=>'旧密码不能为空',
                'password.required'=>'新密码不能为空',
                'password.min'=>'密码不能小于三位',
                'password.confirmed'=>'两次输入的密码不一致',
            ]);
//        var_dump($request->old_password,$request->password);die;
//        $password = bcrypt(123);
//        var_dump($password);die;
        if (Auth::attempt(['name'=>$request->name,'password'=>$request->old_password])){
            $admin->update(
                [
                    'password'=>bcrypt($request->password),
                ]);
        }else{
            session()->flash('danger','修改密码失败,旧密码填写错误');
            return redirect()->back();
        }
        session()->flash('success','修改成功');
        return redirect()->route('admins.index');
    }
}
