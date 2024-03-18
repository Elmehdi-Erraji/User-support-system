<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $token; 
    public $email; 

    public function __construct($token, $email)
    {
        $this->token = $token;
        $this->email = $email;
    }

   
    public function build()
    {
        return $this->subject('Reset Password')
                    ->view('emails.reset_password')
                    ->with([
                        'token' => $this->token,
                        'email' => $this->email,
                    ]);
    }
}
