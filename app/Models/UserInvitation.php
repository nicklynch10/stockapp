<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class UserInvitation extends Model
{
    use HasFactory;
    protected $table="user_invitation";

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'title',
        'link',
        'sender_id'
    ];


    public function send_invite($email)
    {
        Mail::to($email)->send(new \App\Mail\UserInvitation());
    }

}
