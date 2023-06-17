<?php

namespace App\Http\Livewire;

use App\Models\MessageboardGroup;
use Livewire\Component;

class ForumOverview extends Component
{
    public $messageboardGroups = [];

    public function mount()
    {
        $this->messageboardGroups = MessageboardGroup::all();
    }

    public function render()
    {
        return view('livewire.forum-overview');
    }
}
