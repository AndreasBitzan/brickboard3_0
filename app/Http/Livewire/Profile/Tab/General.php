<?php

namespace App\Http\Livewire\Profile\Tab;

use Livewire\Component;

class General extends Component
{
    public $user;

    public function render()
    {
        return view('livewire.profile.tab.general');
    }
}
