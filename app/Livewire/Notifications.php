<?php

namespace App\Livewire;
use Livewire\Attributes\On; 
use Livewire\Component;

class Notifications extends Component
{
    public $notifications = [];

    // channel: notifications
    // event name: NewNotification

    #[On('echo:notifications,NewNotification')]
    public function addNotification($message)
    {
        \Log::info( $message );

        $this->notifications[] = [
            'message' => $message,
            'time' => now()->format('H:i:s'),
        ];
    }

    public function render()
    {
        return view('livewire.notifications');
    }
}
