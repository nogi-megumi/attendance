<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Work;
use App\Models\User;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $date = Carbon::parse($request->date ?? now()->format('Y-m-d'));
        $previousDay = $date->copy()->subDay();
        $nextDay = $date->copy()->addDay();
        $attendances = Work::whereDate('work_start', $date)->paginate(5);

        foreach ($attendances as $attendance) {
            $breaks = $attendance->breakTimes;

            $work_start = new Carbon($attendance->work_start);
            $work_end = new Carbon($attendance->work_end);
            $diff_work = $work_start->diffInSeconds($work_end);

            $work_hours = floor($diff_work / 3600);
            $work_minutes = floor(($diff_work % 3600) / 60);
            $work_seconds = $diff_work % 60;
            $work_dt = Carbon::createFromTime($work_hours, $work_minutes, $work_seconds);

            $attendance['work_start'] = $work_start->format('H:i:s');
            $attendance['work_end'] = $work_end->format('H:i:s');
            $attendance['work_time'] = $work_dt->format('H:i:s');

            if ($breaks) {
                $total_break = 0;

                foreach ($breaks as $break) {
                    $break_start = new Carbon($break->break_start);
                    $break_end = new Carbon($break->break_end);
                    $total_break += $break_start->diffInSeconds($break_end);
                }
                $break_hours = floor($total_break / 3600);
                $break_minutes = floor(($total_break % 3600) / 60);
                $break_seconds = $total_break % 60;
                $break_dt = Carbon::createFromTime($break_hours, $break_minutes, $break_seconds);
                $attendance['break_time'] = $break_dt->format('H:i:s');
                $diff_work -= $total_break;

                $work_hours = floor($diff_work / 3600);
                $work_minutes = floor(($diff_work % 3600) / 60);
                $work_seconds = $diff_work % 60;
                $work_dt = Carbon::createFromTime($work_hours, $work_minutes, $work_seconds);

                $attendance['work_time'] = $work_dt->format('H:i:s');
            } else {
                $attendance['break_time'] = '00:00:00';
            }
        }
        return view('date', compact('date', 'previousDay', 'nextDay', 'attendances'));
    }

    public function userIndex()
    {
        $users = User::paginate(5);
        return view('users_index', compact('users'));
    }
    public function userDetail(User $user)
    {
        $attendances = Work::where('user_id', $user->id)->paginate(5);
        foreach ($attendances as $attendance) {
            $breaks = $attendance->breakTimes;

            $work_start = new Carbon($attendance->work_start);
            $work_end = new Carbon($attendance->work_end);
            $diff_work = $work_start->diffInSeconds($work_end);

            $work_hours = floor($diff_work / 3600);
            $work_minutes = floor(($diff_work % 3600) / 60);
            $work_seconds = $diff_work % 60;
            $work_dt = Carbon::createFromTime($work_hours, $work_minutes, $work_seconds);

            $attendance['work_start'] = $work_start->format('H:i:s');
            $attendance['work_end'] = $work_end->format('H:i:s');
            $attendance['work_time'] = $work_dt->format('H:i:s');

            if ($breaks) {
                $total_break = 0;

                foreach ($breaks as $break) {
                    $break_start =  new Carbon($break->break_start);
                    $break_end = new Carbon($break->break_end);
                    $total_break += $break_start->diffInSeconds($break_end);
                }

                $break_hours = floor($total_break / 3600);
                $break_minutes = floor(($total_break % 3600) / 60);
                $break_seconds = $total_break % 60;
                $break_dt = Carbon::createFromTime($break_hours, $break_minutes, $break_seconds);

                $attendance['break_time'] = $break_dt->format('H:i:s');
                $diff_work -= $total_break;

                $work_hours = floor($diff_work / 3600);
                $work_minutes = floor(($diff_work % 3600) / 60);
                $work_seconds = $diff_work % 60;
                $work_dt = Carbon::createFromTime($work_hours, $work_minutes, $work_seconds);
                $attendance['work_time'] = $work_dt->format('H:i:s');
            } else {
                $attendance['break_time'] = '00:00:00';
            }
            $attendance['date'] = $work_start->format('Y年m月d日');
        }

        return view('user_attendance', compact('user', 'attendances'));
    }
}
