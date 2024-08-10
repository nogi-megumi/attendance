<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests\WorkRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Work;

class WorkController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $date = Carbon::now();
        return view('timestamp', compact('user', 'date'));
    }

    public function store(WorkRequest $request)
    {
        dd($request);
        // 勤務開始の処理
        Work::create(
            $request->only([
                'user_id',
                'work_start',
                'work_end'
            ])
        );
        // $work=new Work;
        // $work->user_id=auth()->user()->id;
        // $work->work_start=Carbon::now();
        // $work->save();
        return back()->with('message', '勤務を開始しました');
    }

    public function update()
    {
        // 勤務終了の処理
    }
}
