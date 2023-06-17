<?php

namespace App\Http\Livewire;

use Livewire\Component;
use WireUi\Traits\Actions;

class TestNotifcations extends Component
{
    use Actions;

    public function shootNotification()
    {
        $this->notification()->info('WORKS');
    }

    public function render()
    {
        return view('livewire.test-notifcations');
    }
}
