<?php

namespace App\Http\Controllers;

use App\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{

    public function index($parent_id=0){
        $categoryList = Menu::all();
        //排序
        $categoryList_new = $this->getChildren($categoryList,$parent_id);
        //3.返回

        return view('menus.index',compact('categoryList_new'));
    }
    /**
     * 找儿子的方法
     */
    private function getChildren(&$categoryList,$parent_id,$deep=0){
        static $children = [];//保存找到的儿子
        //循环所有的数据，比对每条数据中的parent_id,如果等于传入的$parent_id说明儿子找到了
        foreach ($categoryList as $child){
            if($child['parent_id'] == $parent_id){
                $child['name_txt'] = str_repeat("---------",$deep*2).$child['name'];//保存有缩进的名称
                $children[] = $child;
//                var_dump($children);
                $this->getChildren($categoryList,$child['id'],$deep+1);
            }
        }
        //返回找到的儿子
        return $children;
    }

    public function create()
    {
        $menus = Menu::where('parent_id','=',0)->get();
        return view('menus.create',compact('menus'));
    }

    public function store(Request $request)
    {
        $this->validate($request,
            [
                'name'=>'required',
                'sort'=>'required',
                'address'=>'required',
                'parent_id'=>'required',
            ],
            [
                'name.required'=>'菜单名称不能为空',
                'sort.required'=>'排序不能为空',
                'address.required'=>'地址不能为空',
                'parent_id.required'=>'上级分类不能为空',
            ]
        );
        Menu::create(
            [
                'name'=>$request->name,
                'sort'=>$request->sort,
                'parent_id'=>$request->parent_id,
                'address'=>$request->address,
            ]
        );
        session()->flash('success','添加成功');
        return redirect()->route('menus.index');
    }

    public function show(Menu $menu)
    {
        //
    }

    public function edit(Menu $menu)
    {
        $menus = Menu::where('parent_id','=',0)->get();
        return view('menus.edit',compact('menus','menu'));
    }

    public function update(Request $request, Menu $menu)
    {
        $this->validate($request,
            [
                'name'=>'required',
                'sort'=>'required',
                'address'=>'required',
                'parent_id'=>'required',
            ],
            [
                'name.required'=>'菜单名称不能为空',
                'sort.required'=>'排序不能为空',
                'address.required'=>'地址不能为空',
                'parent_id.required'=>'上级分类不能为空',
            ]
        );
        $menu->update(
            [
                'name'=>$request->name,
                'sort'=>$request->sort,
                'parent_id'=>$request->parent_id,
                'address'=>$request->address,
            ]
        );
        session()->flash('success','修改成功');
        return redirect()->route('menus.index');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();
    }

    public static function all()
    {
        $rows = DB::table('menus')->where('parent_id','=',0)->get();
        foreach ($rows as $row){
//            var_dump($row->parent_id);die;
            $val = DB::table('menus')->where('parent_id','=',$row->id)->get();
//            var_dump($val);die;
            $row->vul = $val;
        }
        return $rows;
    }
}
