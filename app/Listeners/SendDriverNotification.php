<?php

namespace App\Listeners;

use App\Events\DriverStatusChanged;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Pusher\Pusher;

class SendDriverNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(DriverStatusChanged $event): void
    {
        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            ['cluster' => env('PUSHER_APP_CLUSTER'),
                'useTLS' => false],
        );
        $pusher->trigger('driver-notification-channel', 'driver-status-changed', [
            'message' => $event->message,
            'message_type' => $event->message_type
        ]);
    }
}
