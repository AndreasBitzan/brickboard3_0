<?php

namespace App\Http\Livewire;

use Livewire\Component;

class MoviePresenter extends Component
{
    public $topic;

    public function render()
    {
        return view('livewire.movie-presenter');
    }
}
