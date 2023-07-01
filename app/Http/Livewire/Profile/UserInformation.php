<?php

namespace App\Http\Livewire\Profile;

use Livewire\Component;

class UserInformation extends Component
{
    public $user;
    public $tab = 'info';

    protected $queryString = ['tab'];

    public function render()
    {
        return view('livewire.profile.user-information');
    }
}
