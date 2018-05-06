<?php

namespace App\Http\Controllers;

use App\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::paginate(5);
        return view('permissions.index',compact('permissions'));
        }

    public function create()
    {
        return view('permissions.create');
        }

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
        $createPost = new Permission();
        $createPost->name         = $request->name;
        $createPost->display_name = $request->display_name;
        $createPost->description  = $request->description;
        $createPost->save();
      session()->flash('success','添加成功');
      return redirect()->route('permissions.index');
        }

    public function edit(Permission $permission)
    {
        return view('permissions.edit',compact('permission'));
        }

    public function update(Request $request,Permission $permission)
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
        $permission->update(
            [
                'name'=>$request->name,
                'display_name'=>$request->display_name,
                'description'=>$request->description,
            ]
        );
        session()->flash('success','修改成功');
        return redirect()->route('permissions.index');
        }

    public function destroy(Permission $permission)
    {
//        dd($permission->id);
        $per =  DB::table('permission_role')->where('permission_id','=',$permission->id)->first();
//        dd($per);
        if (!empty($per)){
            session()->flash('danger','该权限已有角色不能删除');
            return redirect()->route('permission.index');
        }
        $permission->delete();
        }
}
