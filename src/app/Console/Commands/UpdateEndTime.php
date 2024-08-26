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
        $midnight=Carbon::now()->startOfDay();
        // workingユーザーを取得する
        $workingUsers=User::whereHas('works',function($query){
            $query->whereNull('work_end');})->get();
        //  work_endを更新、新しいwork_startを記録
        foreach ($workingUsers as $user) {
            $latestWork=$user->works()->latest()->first();
            $latestWork->work_end = $midnight;
            $latestWork->save();

            $newWork = new Work;
            $newWork->user_id = $user->id;
            $newWork->work_start = $midnight;
            $newWork->save();

            // 最新の休憩レコードを取得、必要に応じて処理
            $latestBreak = $latestWork->breakTimes()->latest()->first();
            if($latestBreak && !$latestBreak->break_end){
                $latestBreak->break_end=$midnight;
                $latestBreak->save();

                $newBreak = new BreakTime;
                $newBreak->work_id = $newWork->id;
                $newBreak->break_start = $midnight;
                $newBreak->save();
            }
        }
    }
}
