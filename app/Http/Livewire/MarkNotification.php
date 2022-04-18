<?php

namespace App\Http\Livewire;

use Auth;
use Livewire\Component;

class MarkNotification extends Component
{
    public $unread = [];
    public $unreadCount;
    public $is_open = false;
    public $read = [];
    public $notify;

    public function open()
    {
        $this->render();
    }

    public function render()
    {
        $this->unread = Auth::user()->unreadNotifications->sortByDesc(
            'created_at'
        );
        $this->read = Auth::user()
            ->notifications->sortByDesc('created_at')
            ->slice(0, 10);
        $this->unread = collect([$this->unread, $this->read])
            ->flatten()
            ->unique()
            ->slice(0, 10);
        $this->unreadCount = Auth::user()->unreadNotifications->count();
        Auth::user()->unreadNotifications->markAsRead();
        return view('livewire.mark-notification');
    }
}
