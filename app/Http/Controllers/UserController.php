<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('is_vip','=',0)->paginate(3);
        return view('users.index',compact('users'));
    }

    public function show(User $user)
    {
        return view('users.show',compact('user'));
    }

    public function edit(User $user)
    {
        $user->update(
            [
                'is_vip'=>1,
            ]
        );
        return redirect()->route('users.index');
    }
}
