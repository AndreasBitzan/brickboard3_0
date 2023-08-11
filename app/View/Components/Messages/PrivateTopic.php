<?php

namespace App\View\Components\Messages;

use App\Models\PrivateTopic as ModelsPrivateTopic;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PrivateTopic extends Component
{
    /**
     * Create a new component instance.
     *
     * @param mixed $read
     * @param mixed $active
     */
    public function __construct(public ModelsPrivateTopic $privateTopic, public $read = false, public $active = false)
    {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|\Closure|string
    {
        return view('components.messages.private-topic');
    }
}
