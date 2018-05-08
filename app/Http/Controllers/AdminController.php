<?php

namespace App\Http\Controllers;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'except' => [ 'create', 'store']
        ]);
    }

    public function index()
    {
//        $a = Auth::user()->name;
//        $a = Auth::user()->can('admins.create');
//        dd($a);
        if (!Auth::user()->can('admins.index')){
            return '你没有该权限';
        }
       $admins =  Admin::paginate(3);
        return view('admins.index',compact('admins'));
    }

    public function create()
    {
        $roles = DB::table('roles')->get();
        return view('admins.create',compact('roles'));
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
        if (!Auth::user()->can('admins.edit')){
            return '你没有该权限';
        }
        $roles = DB::table('roles')->get();
//        dd($roles);
        return view('admins.edit',compact('admin','roles'));
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
//        dd($request->roles);
        $admin->syncRolesWithoutDetaching($request->roles);
        session()->flash('success','修改成功');
        return redirect()->route('admins.index');
    }

    public function destroy(Admin $admin)
    {
        if (!Auth::user()->can('admins.destroy')){
            return '你没有该权限';
        }
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
