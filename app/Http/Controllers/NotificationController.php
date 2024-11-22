<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Routing\ResponseFactory;
use Illuminate\Http\Response;

class NotificationController extends Controller
{
    public function readNotification(Request $request): Response|ResponseFactory
    {
        $notification = Notification::find($request->id);
        $notification->isRead = true;
        $notification->save();
        return response('', 200);
    }
}
