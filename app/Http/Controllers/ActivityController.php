<?php

namespace App\Http\Controllers;

use App\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', [
            'except' => []
        ]);
    }
    public function index()
    {
//        $time = time();
//        dd($time);
//        $activities = Activity::where('end_time','>',"$time")->paginate(3);
        $activities = Activity::paginate(3);
        return view('activities.index',compact('activities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('activities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request->start_time);
        $this->validate($request,
            [
            'title'=>'required',
            'start_time'=>'required',
            'end_time'=>'required',
            'contents'=>'required',
        ],
            [
                'title.required'=>'活动标题不能为空',
                'start_time.required'=>'活动开始时间不能为空',
                'end_time.required'=>'活动结束时间不能为空',
                'contents.required'=>'活动内容不能为空',
            ]);
        $start_time = strtotime($request->start_time);
        $end_time = strtotime($request->end_time);
//        dd($start_time,$end_time);
        Activity::create(
            [
                'title'=>$request->title,
                'contents'=>$request->contents,
                'start_time'=>$start_time,
                'end_time'=>$end_time,
            ]
        );
        session()->flash('success','添加成功');
        return redirect()->route('activities.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function show(Activity $activity)
    {
        $time = strtotime($activity->end_time);
        $times = strtotime($activity->start_time);
        $tu = $time - $time;
//        dd($tu);
        return view('activities.show',compact('activity','$tu'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function edit(Activity $activity)
    {
//        var_dump($activity->title);
        return view('activities.edit',compact('activity'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Activity $activity)
    {
        $this->validate($request,
            [
                'title'=>'required',
                'start_time'=>'required',
                'end_time'=>'required',
                'contents'=>'required',
            ],
            [
                'title.required'=>'活动标题不能为空',
                'start_time.required'=>'活动开始时间不能为空',
                'end_time.required'=>'活动结束时间不能为空',
                'contents.required'=>'活动内容不能为空',
            ]);
        $start_time = strtotime($request->start_time);
        $end_time = strtotime($request->end_time);
        $activity->update(
            [
                'title'=>$request->title,
                'contents'=>$request->contents,
                'start_time'=>$start_time,
                'end_time'=>$end_time,
            ]
        );
        session()->flash('success','修改成功');
        return redirect()->route('activities.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $activity)
    {
        $activity->delete();
    }
}
