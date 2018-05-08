<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InformationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'except' => []
        ]);

//        $this->middleware('guest', [
//            'only' => ['create']
//        ]);
    }
}
