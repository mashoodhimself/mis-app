<?php

namespace App\Livewire\Admin;

use App\Models\Feed;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateFeed extends Component
{

    use WithFileUploads;

    #[Validate('required|max:100')]
    public $feed_title;

    #[Validate('required')]
    public $feed_desc;

    #[Validate('max:2024')]
    public $feed_file;



    public function save()
    {
        $this->validate();

        try {

            if(!empty($this->feed_file)) {
                $filename = time() . '-' . $this->feed_file->getClientOriginalName();
                $this->feed_file->storeAs('uploads', $filename, 'mis');
            }
            
            Feed::create([
                'user_id' => auth()->user()->id,
                'title' => $this->feed_title,
                'description' => $this->feed_desc,
                'audiance' => 2,
                'attachment' => $filename ?? '',
            ]);

            session()->flash('success', 'Feed created successfully.');

        } catch (\Exception $e) {
            \Log::error('error occured while creating a feed: '. $e->getMessage());
            session()->flash('error', 'Something went wrong, while creating a feed.');
        } finally {
            $this->reset('feed_title', 'feed_desc', 'feed_file');
        }
    }

    public function render()
    {
        return view('livewire.admin.create-feed')->layout('layouts.app');
    }
}
