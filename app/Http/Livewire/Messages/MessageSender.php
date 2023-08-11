<?php

namespace App\Http\Livewire\Messages;

use Livewire\Component;

class MessageSender extends Component
{
    public $content;
    // public $activePrivat

    protected $rules = [];

    public function render()
    {
        return view('livewire.messages.message-sender');
    }
}
