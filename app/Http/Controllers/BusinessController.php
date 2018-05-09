<?php

namespace App\Http\Controllers;

use App\Business;
use App\Category;
use App\Information;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class BusinessController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'except' => []
        ]);
    }

    public function index()
    {
       $businesses =  Business::paginate(3);
        return view('businesses.index',compact('businesses'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('businesses.create',compact('categories'));
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
                'email'=>'required|email',
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
                'email.required'=>'邮箱不能为空',
                'email.email'=>'邮箱格式不正确',
            ]);
        DB::transaction(function ()use($request){
            $information_id = Information::create(
                [
                    'shop_name'=>$request->name,
                    'brand'=>$request->brand,
                    'bao'=>$request->bao,
                    'on_time'=>$request->on_time,
                    'zhun'=>$request->zhun,
                    'fengniao'=>$request->fengniao,
                    'piao'=>$request->piao,
                    'email'=>$request->email,
                ]);
//        var_dump($information_id->id);die;
            DB::transaction(function ()use($request){
                $fileName = $request->file('logo')->store('public/businesses');
                $file = url(Storage::url($fileName));
                $information_id = Information::create(
                    [
                        'shop_name'=>$request->name,
                        'brand'=>$request->brand,
                        'bao'=>$request->bao,
                        'on_time'=>$request->on_time,
                        'zhun'=>$request->zhun,
                        'fengniao'=>$request->fengniao,
                        'piao'=>$request->piao,
                        'shop_img'=>$file,
                    ]);
                Business::create(
                    [
                        'name'=>$request->name,
                        'logo'=>$file,
                        'phone'=>$request->phone,
                        'password'=>bcrypt($request->password),
                        'categories_id'=>$request->categories_id,
                        'information_id'=>$information_id->id,
                        'email'=>$request->email,
                    ]
                );
            });
        });

        session()->flash('success','注册成功');
        return redirect()->route('businesses.index');
        }

    public function edit(Business $business)
    {
        return view('businesses.edit',compact('business'));
    }

    public function update(Request $request,Business $business)
    {
        $this->validate($request,
            [
                'name'=>'required',
                'logo'=>'required|image',
                'password'=>'required|min:3|confirmed',
                'phone'=>'required|min:11|max:12',
                'email'=>'required|email',
            ],
            [
                'name.required'=>'商家名称不能为空',
                'logo.required'=>'商家图片不能为空',
                'logo.image'=>'图片格式不正确',
                'password.required'=>'密码不能为空',
                'password.confirmed'=>'密码两次填写不一致',
                'password.min'=>'密码不能小于三位',
                'phone.min'=>'电话号码不能小于11位',
                'phone.max'=>'电话号码不能超过12位',
                'phone.required'=>'电话号码不能为空',
                'email.required'=>'邮箱不能为空',
                'email.email'=>'邮箱格式不正确',
            ]);
        $fileName = $request->file('logo')->store('public/businesses');
        $file = url(Storage::url($fileName));
        $business->update(
            [
                'name'=>$request->name,
                'logo'=>$file,
                'phone'=>$request->phone,
                'password'=>bcrypt($request->password),
                'email'=>$request->email,
            ]
        );
        DB::table('information')
            ->where('id', $business->information_id)
            ->update(['shop_img' => $file]);
        session()->flash('success','修改成功');
        return redirect()->route('businesses.index');
    }

    public function destroy(Business $business)
    {
//        dd($business->information_id);
        $business->delete();
        DB::table('information')->where('id','=',$business->information_id)->delete();
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
        $information_id = $business->information_id;
//            var_dump($business->information_id);die;
        $information = DB::table('information')->where('id','=',"$information_id")->get();
//        var_dump($information);die;
        return view('businesses.show',compact('information'));
        }

    public function review(Business $business)
    {
//        dd($business->name);
//        $review = 1;
        $business->update([
            'is_review'=>$business->is_review =1,
        ]);
        $email = $business->email;
        $business_name = $business->name;
       Mail::send(
            'businesses.mail',//邮件视图模板
            ['name'=>$business_name],
            function ($message)use($email){
                $message->to($email)->subject('审核通知');
            }
        );
//        return '邮件发送成功';
        session()->flash('success','审核通过');
        return redirect()->route('businesses.index');
        }
}
