<?php

namespace App\Http\Controllers;

use App\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class BusinessController extends Controller
{
    public function index()
    {
       $businesses =  Business::paginate(3);
        return view('businesses.index',compact('businesses'));
    }
    public function create()
    {
        return view('businesses.create');
        }

    public function store(Request $request)
    {
        $this->validate($request,
            [
            'name'=>'required',
            'logo'=>'required|image',
             'password'=>'required|min:3|confirmed',
             'captcha'=>'required|captcha',
            'phone'=>'required|min:11|max:12',
        ],
            [
            'name.required'=>'商家名称不能为空',
            'logo.required'=>'商家图片不能为空',
            'logo.image'=>'图片格式不正确',
            'password.required'=>'密码不能为空',
            'password.confirmed'=>'密码两次填写不一致',
            'password.min'=>'密码不能小于三位',
            'captcha.required'=>'验证码不能为空',
            'captcha.captcha'=>'验证码填写错误',
            'phone.min'=>'电话号码不能小于11位',
            'phone.max'=>'电话号码不能超过12位',
            'phone.required'=>'电话号码不能为空',
            ]);
        $fileName = $request->file('logo')->store('public/businesses');
//        $img = Image::make($fileName)->resize(200, 200)->insert('public/businesses', 'bottom-right', 15, 10);
//        $img->save('public/businesses');
        Business::create(
            [
                'name'=>$request->name,
                'logo'=>$fileName,
                'phone'=>$request->phone,
                'is_review'=>1,
                'password'=>bcrypt($request->password),
            ]
        );
        session()->flash('success','注册成功');
        return redirect()->route('businesses.index');
        }

    public function login()
    {
        return view('businesses.login');
        }

    public function add_login(Request $request)
    {
        $this->validate($request,
            [
                'name'=>'required',
                'password'=>'required|min:3|confirmed',
                'captcha'=>'required|captcha',
                'phone'=>'required|min:11|max:12',
            ],
            [
                'name.required'=>'商家名称不能为空',
                'password.required'=>'密码不能为空',
                'password.confirmed'=>'密码两次填写不一致',
                'password.min'=>'密码不能小于三位',
                'captcha.required'=>'验证码不能为空',
                'captcha.captcha'=>'验证码填写错误',
                'phone.min'=>'电话号码不能小于11位',
                'phone.max'=>'电话号码不能超过12位',
                'phone.required'=>'电话号码不能为空',
            ]);
//var_dump($request->has('rememberMe'));die;
        if (Auth::attempt(['name' => $request->name, 'password' => $request->password,'phone'=>$request->phone],$request->has('rememberMe'))) {
            session()->flash('success','登录成功');
            return redirect()->route('businesses.index');
        }else{
            session()->flash('danger','登录失败,用户名或密码错误');
            return redirect()->back();
        }

        }

    public function show(Business $business)
    {
//        var_dump($business);die;
        $is_review = 1;
        $business->update([
            'is_review'=>$is_review,
        ]);
        session()->flash('success','审核成功');
        return redirect()->route('businesses.index');
        }
}
