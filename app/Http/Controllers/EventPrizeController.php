<?php

namespace App\Http\Controllers;

use App\Event_prize;
use App\Events;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Element;

class EventPrizeController extends Controller
{

    public function index()
    {
        $event_prizes = Event_prize::paginate(5);
        return view('event_prize.index',compact('event_prizes'));
    }


    public function create()
    {
        $events = Events::all();
//        dd($events);die;
        return view('event_prize.create',compact('events'));
    }


    public function store(Request $request)
    {
        $this->validate($request,
            [
                'name'=>'required',
                'events_id'=>'required',
                'description'=>'required',
            ],
            [
                'name.required'=>'奖品名称不能为空',
                'events_id.required'=>'所属活动不能为空',
                'description.required'=>'详情不能为空',
            ]
        );
        Event_prize::create(
            [
                'name'=>$request->name,
                'events_id'=>$request->events_id,
                'description'=>$request->description,
            ]
        );
        session()->flash('success','添加成功');
        return redirect()->route('event_prize.index');
    }


    public function show(Event_prize $event_prize)
    {

    }


    public function edit(Event_prize $event_prize)
    {
        $events = Events::all();
//        dd($events);die;
        return view('event_prize.edit',compact('events','event_prize'));
    }


    public function update(Request $request, Event_prize $event_prize)
    {
        $this->validate($request,
            [
                'name'=>'required',
                'events_id'=>'required',
                'description'=>'required',
            ],
            [
                'name.required'=>'奖品名称不能为空',
                'events_id.required'=>'所属活动不能为空',
                'description.required'=>'详情不能为空',
            ]
        );
        $event_prize->update(
            [
                'name'=>$request->name,
                'events_id'=>$request->events_id,
                'description'=>$request->description,
            ]
        );
        session()->flash('success','修改成功');
        return redirect()->route('event_prize.index');
    }


    public function destroy(Event_prize $event_prize)
    {
        $event_prize->delete();
    }
}
