<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;

class UserImage extends Component
{
    public $user;

    public function render()
    {
        return view('livewire.profile.user-image');
    }
}
