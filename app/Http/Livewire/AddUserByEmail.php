<?php

namespace App\Http\Livewire;

use App\Models\UserInvitation;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AddUserByEmail extends Component
{

    public $title;
    public $email;
    public $first_name;
    public $last_name;


    public function render()
    {
        return view('livewire.add-user-by-email');
    }

    public function addNewUser()
    {
        $this->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
        ],
        ['first_name.required' => 'First name is required',
         'last_name.required' => 'Last name is required',
         'email.required' => 'Email is required' ]);

        if(UserInvitation::where('email', $this->email)->first())
        {
            session()->flash('flash.banner','The given email already send invitation');
            session()->flash('flash.bannerStyle','danger');
            $this->redirectRoute('user.manage-invites');
        }
        else
        {
            $userInvitation = new UserInvitation();
            $userInvitation->first_name = $this->first_name;
            $userInvitation->last_name = $this->last_name;
            $userInvitation->email = $this->email;
            $userInvitation->title = $this->title;
            $userInvitation->sender_id = Auth::user()->id;
            $userInvitation->link = '/register/';
            $userInvitation->save();

            $userInvitation->send_invite($this->email);
            session()->flash('flash.banner', 'Invitation Sent!');

            $this->redirectRoute('user.manage-invites');
        }
    }
}
