<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests\WorkRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Work;
use App\Models\BreakTime;

class WorkController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $work=Work::where('user_id',$user->id)->latest()->first();
        // $break=BreakTime::where('user_id', $user->id)->latest()->first();
        $start_time = Carbon::now();
        $end_time=Carbon::now();
        return view('timestamp', compact('user','work', 'start_time', 'end_time'));
        
    }

    public function store()
    {
        // 勤務開始の処理
        $user = Auth::user();
        $timestamp = Carbon::now();
        Work::create([
            'user_id' => $user->id,
            'work_start' => $timestamp
        ]);
        return back()->with('message', '勤務開始を記録しました');
    }

    public function update(Work $work, WorkRequest $request)
    {
        // 勤務終了の処理
        Work::where('user_id', $request->user_id)->latest()->first();
        $work->update([
            'work_end'=>$request->work_end
        ]);
        return back()->with('message', '勤務終了を記録しました');
    }
}
