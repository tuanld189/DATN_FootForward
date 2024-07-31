<?php
// namespace App\Mail;

// use Illuminate\Bus\Queueable;
// use Illuminate\Mail\Mailable;
// use Illuminate\Queue\SerializesModels;

// class AccountActivationMail extends Mailable
// {
//     use Queueable, SerializesModels;

//     public $user;
//     public $activationCode;

//     public function __construct($user, $activationCode)
//     {
//         $this->user = $user;
//         $this->activationCode = $activationCode;
//     }

//     public function build()
//     {
//         return $this->view('emails.account_activation')
//                     ->with([
//                         'user' => $this->user,
//                         'activationCode' => $this->activationCode,
//                     ]);
//     }
// }
