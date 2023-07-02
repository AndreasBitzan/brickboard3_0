<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;

class UserImage extends Component
{
    public $user;

    protected $listener = ['refreshImage' => '$refresh'];

    public function render()
    {
        return view('livewire.profile.user-image');
    }
}
