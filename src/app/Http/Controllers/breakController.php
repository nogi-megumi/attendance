<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\BreakRequest;
use App\Models\BreakTime;
use Carbon\Carbon;

class breakController extends Controller
{
    public function store(){
        // 休憩開始の処理
        $user = Auth::user();
        $timestamp = Carbon::now();
        BreakTime::create([
            'user_id' => $user->id,
            'break_start' => $timestamp
        ]);
        return back()->with('message', '休憩開始を記録しました');

    }

    public function update(BreakTime $breaktime,BreakRequest $request){
        // 休憩終了の処理
        BreakTime::where('user_id', $request->user_id)->latest()->first();
        $breaktime->update([
            'break_end' => $request->break_end
        ]);
        return back()->with('message', '休憩終了を記録しました');

    }
}
