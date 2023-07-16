<?php

namespace App\Http\Livewire;

use App\Models\MovieRole;
use Livewire\Component;

class MoviePresenter extends Component
{
    public $topic;
    public $movieRoles = [];

    public function mount()
    {
        $this->movieRoles = MovieRole::all();
    }

    public function getRoleName($id = 1)
    {
        return $this->movieRoles->where('id', $id)->first()->name;
    }

    public function render()
    {
        return view('livewire.movie-presenter');
    }
}
