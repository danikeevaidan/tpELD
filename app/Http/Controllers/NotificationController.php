<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\ResponseFactory;
use Illuminate\Http\Response;

class NotificationController extends Controller
{
    public function readNotification(Request $request): Response|ResponseFactory
    {
        $notification = Notification::find($request->id);
        $notification->read_at = new Carbon();
        $notification->save();
        return response('', 200);
    }
}
