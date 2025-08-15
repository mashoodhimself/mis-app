<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ViewUser extends Component
{
    use WithPagination;

    protected $listeners = ['confirmDelete' => 'destroy'];

    public function confirmDelete($id)
    {
        $this->dispatch('show-delete-confirmation', id: $id);
    }

    public function destroy($id)
    {
        try {
            User::findOrFail($id)->delete();
            session()->flash('success', 'User deleted successfully...');
        } catch (\Exception $e) {
            \Log::error("Something went wrong while deletting a user: " . $e->getMessage());
            session()->flash('success', 'User deleted successfully...');
        }
    }

    public function render()
    {
        $users = User::select('id', 'name', 'email', 'username', 'role')->where('id', '!=', auth()->id())->simplePaginate(10);
        return view('livewire.admin.view-user')->with(['users' => $users])->layout('layouts.app');
    }
}
