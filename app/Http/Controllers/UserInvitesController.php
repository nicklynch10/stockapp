<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserInvitesController extends Controller
{

    public function manageInvites()
    {
        return view('user.invites');
    }

    public function manage_users()
    {
        return view('invitation.manage-invites');
    }
}
