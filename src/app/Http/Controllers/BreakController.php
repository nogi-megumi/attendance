<?php

namespace App\Http\Controllers;

use App\Http\Requests\BreakRequest;
use App\Models\BreakTime;

class breakController extends Controller
{
    public function store(BreakRequest $request)
    {
        BreakTime::create(
            $request->only([
                'work_id',
                'break_start'
            ])
        );
        return back()->with('message', '休憩開始を記録しました');
    }

    public function update(BreakRequest $request)
    {
        $breaktime = BreakTime::where('work_id', $request->work_id)->latest()->first();
        $breaktime->update(
            $request->only(['break_end'])
        );
        return back()->with('message', '休憩終了を記録しました');
    }
}
