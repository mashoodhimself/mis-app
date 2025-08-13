<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class ViewUser extends Component
{
    public $users;

    public function mount()
    {
        $this->users = User::select('id', 'name', 'email', 'username', 'role')->where('id', '!=', auth()->user()->id)->get();
    }

    public function render()
    {
        return view('livewire.admin.view-user')->layout('layouts.app');
    }
}
