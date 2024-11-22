<?php

namespace App\Jobs;

use App\Events\DriverStatusChanged;
use App\Models\Driver;
use Carbon\Carbon;
use DateTime;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class FMCSACheck implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $drivers = Driver::all();

        foreach ($drivers as $driver) {
            $last_entry = $driver->schedule_entries->last();
            $last_entry_log_time = new Carbon($last_entry->log_time);
            $now = Carbon::now();
            $duration = $last_entry_log_time->diffInHours($now);

            /*
             * Check if driver is driving for less than 8 consecutive hours
            */
            if($last_entry->status == 1 and $duration>=7) {
                event(new DriverStatusChanged(Driver::find(6),
                    "Driver {$driver->user->name} has driven for the last $duration hours. Better to stop driving now!!!", 'warning'));
            }
        }
    }
}
