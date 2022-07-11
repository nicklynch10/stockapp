<?php

namespace App\Http\Livewire;

use App\Models\UserInvitation;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserInvites extends Component
{
    public $search;
    public $selectedInvitation;
    public $confirmDeleteInvitation = false;

    public function render()
    {
        return view('livewire.user-invites',
            ['users' => UserInvitation::where('sender_id', Auth::user()->id)
                ->when($this->search, function ($q) {
                    $q->where(function ($q) {
                        $q->where('user_invitation.first_name', 'like', "$this->search%")
                            ->orWhere('user_invitation.last_name', 'like', "$this->search%")
                            ->orWhere('user_invitation.email', 'like', "$this->search%");
                    });
                })
                ->orderByDesc('created_at')
                ->paginate()]);
    }

    public function confirmDeletingInvitation($inviteID)
    {
        $this->selectedInvitation = $this->getInvitation($inviteID);
        if ($this->selectedInvitation) {
            $this->confirmDeleteInvitation = true;
        } else {
            $this->reset('selectedInvitation');
        }
    }

    public function cancelDeletingInvitation()
    {
        $this->confirmDeleteInvitation = false;
    }

    public function deleteInvitation()
    {
        if ($this->selectedInvitation) {
            $this->selectedInvitation->delete();
            $this->reset(['selectedInvitation', 'confirmDeleteInvitation']);
            $this->dispatchBrowserEvent('notify', [
                'style' => 'danger',
                'message' => 'Invitation Deleted',
            ]);
        }
    }

    public function getInvitation($inviteID)
    {
        $invitation = UserInvitation::where('id', $inviteID)->first();
        return $invitation ? $invitation : null;
    }
}
