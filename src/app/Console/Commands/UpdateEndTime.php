<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\BreakTime;
use App\Models\User;
use App\Models\Work;
use Illuminate\Support\Facades\Log;

class UpdateEndTime extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'time:update_end';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update work and break end time at midnight';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $midnight = Carbon::now()->startOfDay();
        $working_users = User::whereHas('works', function ($query)
        {
            $query->whereNull('work_end');
        })->get();
        
        foreach ($working_users as $user)
        {
            $latest_work = $user->works()->latest()->first();
            $latest_work->work_end = $midnight;
            $latest_work->save();

            $new_work = new Work;
            $new_work->user_id = $user->id;
            $new_work->work_start = $midnight;
            $new_work->save();

            $latest_break = $latest_work->breakTimes()->latest()->first();
            if ($latest_break && !$latest_break->break_end)
            {
                $latest_break->break_end = $midnight;
                $latest_break->save();

                $new_break = new BreakTime;
                $new_break->work_id = $new_work->id;
                $new_break->break_start = $midnight;
                $new_break->save();
            }
        }
    }
}
