<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Activity;
use Carbon\Carbon;

class CloseExpiredActivities extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:close-expired-activities';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $threshold = Carbon::today()->subDays(30);
        $count = Activity::where('due_date','<',$threshold)->where('closed',false)->update(['closed'=>true]);
        $this->info("Closed $count activities older than 30 days.");
    }
}
