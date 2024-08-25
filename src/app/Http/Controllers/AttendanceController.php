<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Work;
use App\Models\BreakTime;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function index(Request $request){
        // 日付別のデータ一覧
        dd($request);
        $date=Carbon::parse($request->date ?? now()->format('Y-m-d'));
        $attendances=Work::whereDate('work_start',$date)->pagenate(5);

        // 時間差分の処理
        foreach ($attendances as $index => $attendance) {
            dd($index);
            $breaks=$attendance->breakTimes;
            // 休憩時間の差分
            foreach ($breaks as $break) {
                $break_start=$break->break_start;
                $start_dt=new Carbon($break_start);
                $break_end=$break->break_end;
                $end_dt=new Carbon($break_end);

                $diff_break=$start_dt->diffInSeconds($end_dt);
            }
            // 勤務時間の差分
            $work_start= new Carbon($attendance->work_start);
            $work_end = new Carbon($attendance->work_end);
            $diff_seconds=$work_start->diffInSeconds($work_end);
            $diff_work=$diff_seconds - $diff_break;
            // 秒単位から、H:i:sにする
            $break_hours
            = floor($diff_break / 3600);
            $minutes = floor(($diff_break % 3600) / 60);
            $seconds = $diff_break % 60;
            $break_dt = Carbon::createFromTime($break_hours, $break_minutes, $break_seconds);

            $work_hours = floor($diff_work / 3600);
            $work_minutes = floor(($diff_work % 3600) / 60);
            $work_seconds = $diff_work % 60;
            $work_dt = Carbon::createFromTime($work_hours, $work_minutes, $work_seconds);

            $attendances['index']->break_time=$break_dt->format('H:i:s');
            $attendances['index']->work_time = $work_dt->format('H:i:s');
        }
        return view('date',compact('date','attendances'));
    }
}
