<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class ViewUser extends Component
{

    protected $listeners = ['confirmDelete' => 'destroy'];

    public $users;

    public function mount()
    {
        $this->users = User::select('id', 'name', 'email', 'username', 'role')->where('id', '!=', auth()->id())->get();
    }

    public function confirmDelete($id)
    {
        $this->dispatch('show-delete-confirmation', id: $id);
    }

    public function destroy($id)
    {
        try {
            User::findOrFail($id)->delete();
            $this->users = $this->users->reject( fn($user) => $user->id === $id);
            session()->flash('success', 'User deleted successfully...');
        } catch (\Exception $e) {
            \Log::error("Something went wrong while deletting a user: " . $e->getMessage());
            session()->flash('success', 'User deleted successfully...');
        }
    }

    public function render()
    {   
        return view('livewire.admin.view-user')->layout('layouts.app');
    }
}
