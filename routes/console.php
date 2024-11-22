<?php

use App\Events\DriverStatusChanged;

use App\Jobs\FMCSACheck;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use Pusher\Pusher;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::job(new FMCSACheck)->everyMinute();
