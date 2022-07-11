<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class UserInvitation extends Mailable
{
    use Queueable, SerializesModels;
    public $user_invitation;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mails.user-invitation',[
            'sender'    => $this->senderName()->name,
            'appName'   => appName(),
            'appLogo'   => appLogo(),
        ])->subject($this->senderName()->name.' has invited you to join '.AppName().'!');
    }

    public function senderName()
    {
        return User::select('name')->where('id', Auth::user()->id)->first();
    }
}
