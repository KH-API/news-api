<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Verify extends Mailable
{
    use Queueable, SerializesModels;
    protected $verifyUser;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($verifyUser)
    {
        $this->verifyUser= $verifyUser;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $verifyUser = $this->verifyUser;
        return $this->view('mails.verifyUser',['verifyUser'=>$verifyUser]);
    }
}
