<?php

namespace App\Livewire\Admin;

use App\Models\Feed;
use Livewire\Component;
use Livewire\WithPagination;

class ViewFeed extends Component
{
    use WithPagination;

    public function render()
    {
        $feeds = Feed::with('user')->select('id', 'user_id', 'title', 'description', 'attachment')->simplePaginate(5);
        return view('livewire.admin.view-feed', ['feeds' => $feeds])->layout('layouts.app');
    }
}
