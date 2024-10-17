<?php

namespace App\Http\Controllers;

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
        $work = Work::where('user_id', $user->id)->latest()->first();
        $break=null;
        if (!empty($work->id)) {
            $break = BreakTime::where('work_id', $work->id)->latest()->first();
            }

        $time = Carbon::now()->format('Y-m-d H:i:s');
        return view('timestamp', compact('user', 'work', 'break', 'time'));
    }

    public function store(WorkRequest $request)
    {
        Work::create(
            $request->only(['user_id', 'work_start'])
        );
        return back()->with('message', '勤務開始を記録しました');
    }

    public function update(WorkRequest $request)
    {
        $work = Work::where('user_id', $request->user_id)->latest()->first();
        $work->update(
            $request->only(['work_end'])
        );
        return back()->with('message', '勤務終了を記録しました');
    }
}
