<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'except' => []
        ]);
    }

    //角色列表
    public function index()
    {
        $roles = Role::paginate();
        return view('roles.index',compact('roles'));
        }
   //添加表单
    public function create()
    {
        $permissions = Permission::all();
        return view('roles.create',compact('permissions'));
    }
    //添加保存
    public function store(Request $request)
    {
        $this->validate($request,
            [
                'name'=>'required',
                'display_name'=>'required',
                'description'=>'required',
            ],
            [
                'name.required'=>'权限名称不能为空',
                'display_name.required'=>'权限名称不能为空',
                'description.required'=>'权限名称不能为空',
            ]
        );
//        var_dump($request->permission);die;
        $owner = new Role();
        $owner->name         = $request->name;
        $owner->display_name = $request->display_name;
        $owner->description  = $request->description;
        $owner->save();
        $owner->attachPermissions($request->permission);
        session()->flash('success','添加成功');
        return redirect()->route('roles.index');
    }
    //修改回显
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        $a=$role->permissions()->get();
//        dd($a);
        $roles = [];
        foreach ($a as $b){
//            var_dump($b->id);
            $roles[] = $b->id;
        }
        return view('roles.edit',compact('role','roles','permissions'));
    }
    //修改保存
    public function update(Request $request,Role $role)
    {
        $this->validate($request,
            [
                'name'=>'required',
                'display_name'=>'required',
                'description'=>'required',
            ],
            [
                'name.required'=>'权限名称不能为空',
                'display_name.required'=>'权限名称不能为空',
                'description.required'=>'权限名称不能为空',
            ]
        );
        $role->update([
            'name'=>$request->name,
            'display_name'=>$request->name,
            'description'=>$request->description,
        ]);
//        dd($request->permission);
        $role->syncPermissions($request->permission);
        session()->flash('success','修改成功');
        return redirect()->route('roles.index');
    }
    //删除角色
    public function destroy(Role $role)
    {
        $role->delete();
    }
}
