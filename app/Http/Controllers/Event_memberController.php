<?php

namespace App\Http\Controllers;

use App\Event_member;
use Illuminate\Http\Request;

class Event_memberController extends Controller
{
    public function index()
    {
        $event_members = Event_member::paginate(5);
        return view('event_members.index',compact('event_members'));
    }
}
