<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\BreakRequest;
use App\Models\BreakTime;
use Carbon\Carbon;
use App\Models\Work;

class breakController extends Controller
{
    public function store()
    {
        // 休憩開始の処理
        $work = Work::where('user_id', auth()->id())->latest()->first();
        $timestamp = Carbon::now();
        BreakTime::create([
            'work_id' => $work->id,
            'break_start' => $timestamp
        ]);
        return back()->with('message', '休憩開始を記録しました');
    }

    public function update()
    {
        // 休憩終了の処理
        $work = Work::where('user_id', auth()->id())->latest()->first();
        $breaktime=BreakTime::where('work_id',$work->id)->latest()->first();
        $timestamp = Carbon::now();
        $breaktime->update([
            'break_end' => $timestamp,
        ]);
        return back()->with('message', '休憩終了を記録しました');
    }
}
