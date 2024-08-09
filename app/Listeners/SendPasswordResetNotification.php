<?php

namespace App\Listeners;

use App\Events\PasswordResetRequested;
use App\Mail\PasswordResetMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendPasswordResetNotification implements ShouldQueue
{
    public function handle(PasswordResetRequested $event)
    {
        Mail::to($event->user->email)->send(new PasswordResetMail($event->user, $event->newPassword));
    }
}
