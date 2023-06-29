<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DarkModeToggler extends Component
{
    public $darkMode = false;

    public function mount()
    {
        // TODO SAVE TO USER TABLE
        $this->darkMode = session('darkMode', 'false');
    }

    public function toggleMode()
    {
        $this->darkMode = true;
    }

    public function updatedDarkMode($value)
    {
        session(['darkMode' => $value ? true : false]);
        $this->dispatchBrowserEvent('toggleDarkMode', ['darkMode' => $this->darkMode ? true : false]);
    }

    public function render()
    {
        return view('livewire.dark-mode-toggler');
    }
}
