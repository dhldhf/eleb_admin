<?php

namespace App\Http\Controllers;

use App\Events;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'except' => []
        ]);
    }

    public function index()
    {
        $events = Events::paginate(5);
        return view('events.index',compact('events'));
    }


    public function create()
    {
        return view('events.create');
    }


    public function store(Request $request)
    {
        $this->validate($request,
            [
                'title'=>'required',
                'contents'=>'required',
                'signup_start'=>'required',
                'signup_end'=>'required',
                'prize_date'=>'required',
                'signup_num'=>'required',
            ],
            [
                'title.required'=>'活动名称不能为空',
                'contents.required'=>'详情不能为空',
                'signup_start.required'=>'报名开始日期不能为空',
                'signup_end.required'=>'报名结束日期不能为空',
                'prize_date.required'=>'开奖日期不能为空',
                'signup_num.required'=>'人数限制不能为空',
            ]
        );
        if ($request->signup_start >= $request->signup_end){
            session()->flash('danger','报名结束时间不能小于或等于报名开始时间');
            return redirect()->route('events.create');
        }
        if ($request->signup_end >= $request->prize_date){
            session()->flash('danger','开奖时间不能小于或等于报名结束时间');
            return redirect()->route('events.create');
        }
        Events::create(
            [
                'title'=>$request->title,
                'content'=>$request->contents,
                'signup_start'=>$request->signup_start,
                'signup_end'=>$request->signup_end,
                'prize_date'=>$request->prize_date,
                'signup_num'=>$request->signup_num,
            ]
        );
        session()->flash('success','添加成功');
        return redirect()->route('events.index');
    }


    public function show(Events $event)
    {
//        var_dump($event->id);die;
        $event_prizes = DB::table('event_prizes')->where('events_id','=',$event->id)->get();
        return view('events.show',compact('event','event_prizes'));
    }


    public function edit(Events $event)
    {
//        dd($event->title);
        return view('events.edit',compact('event'));
    }


    public function update(Request $request, Events $event)
    {
        $this->validate($request,
            [
                'title'=>'required',
                'contents'=>'required',
                'signup_start'=>'required',
                'signup_end'=>'required',
                'prize_date'=>'required',
                'signup_num'=>'required',
            ],
            [
                'title.required'=>'活动名称不能为空',
                'contents.required'=>'详情不能为空',
                'signup_start.required'=>'报名开始日期不能为空',
                'signup_end.required'=>'报名结束日期不能为空',
                'prize_date.required'=>'开奖不能为空',
                'signup_num.required'=>'人数限制不能为空',
            ]
        );
        $event->update(
            [
                'title'=>$request->title,
                'content'=>$request->contents,
                'signup_start'=>$request->signup_start,
                'signup_end'=>$request->signup_end,
                'prize_date'=>$request->prize_date,
                'signup_num'=>$request->signup_num,
            ]
        );
        session()->flash('success','修改成功');
        return redirect()->route('events.index');
    }


    public function destroy(Events $event)
    {
        $event->delete();
    }

    public function lottery(Events $event)
    {
       $event_prizes = DB::table('event_prizes')->where('events_id','=',$event->id)->get();
       $event_members = DB::table('event_members')->where('events_id','=',$event->id)->get();
       $event_num = DB::select("select count(*) as num from event_prizes WHERE events_id={$event->id}");
       $members_num = DB::select("select count(*) as num from event_members WHERE events_id={$event->id}");
        $prizes_num = $event_num[0]->num;
        $member_num = $members_num[0]->num;
        if ($prizes_num == 0){
            session()->flash('success','该活动还没奖品不能抽奖请添加奖品再开奖');
            return redirect()->route('event_prize.create');
        }
        if($member_num == 0){
            session()->flash('success','该活动还没商家报名不能开奖');
            return redirect()->route('events.index');
        }
        $time = date('Y-m-d');
        if ($time <= $event->signup_end){
            session()->flash('success','该活动报名日期未截止,不能开奖');
            return redirect()->route('events.index');
        }
       $shop = [];
       foreach ($event_members as $event_member){
           $shop[] = $event_member->member_id;
       }
//               var_dump($nu);die;
        foreach ($event_prizes as $event_prize){
//            $nu = mt_rand(0,$num-1);
            shuffle($shop);
            $nu = array_pop($shop);
            if ($nu == null){
                break;
            }
//            dd($event_prize->id);die;
            DB::table('event_prizes')
                ->where('id', $event_prize->id)
                ->update(['member_id' => $nu]);
        }
        $event->update(
            [
                'is_prize'=>1,
            ]
        );
        session()->flash('success','开奖成功');
        return redirect()->route('events.index');
//        dd($event_prizes,$event_members);
    }

    public function winning(Events $event)
    {
        $event_prizes = DB::table('event_prizes')->where('events_id','=',$event->id)->get();
//        dd($event_prizes);
        foreach ($event_prizes as $event_prize){
            $businesses = DB::table('businesses')->where('id','=',$event_prize->member_id)->get();
//            dd($businesses);
            $event_prize->bu=$businesses;
        }
        return view('events.winning',compact('event_prizes'));

    }
}
