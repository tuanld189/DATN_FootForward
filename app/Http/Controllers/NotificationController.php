<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Đánh dấu tất cả các thông báo chưa đọc là đã đọc.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function markAsRead()
    {
        $user = Auth::user();

        if ($user) {
            $user->unreadNotifications->markAsRead();
        }

        return response()->json(['status' => 'success']);
    }
}
