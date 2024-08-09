<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
class PasswordResetMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $newPassword;

    public function __construct(User $user, $newPassword)
    {
        $this->user = $user;
        $this->newPassword = $newPassword;
    }

    public function build()
    {
        return $this->subject('Cập nhật mật khẩu sau khi quên mật khẩu')
                    ->markdown('emails.password_reset')
                    ->with([
                        'user' => $this->user,
                        'newPassword' => $this->newPassword,
                    ]);

    }
}
