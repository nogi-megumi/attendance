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
    public function store(BreakRequest $request)
    {
        // 休憩開始の処理
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
        // 休憩終了の処理
        $breaktime = BreakTime::where('work_id', $request->work_id)->latest()->first();
        $breaktime->update(
            $request->only(['break_end'])
        );
        return back()->with('message', '休憩終了を記録しました');
    }
}
