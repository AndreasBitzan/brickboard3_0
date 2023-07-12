<?php

namespace App\View\Components\Forum;

use App\Models\Messageboard;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MessageboardItem extends Component
{
    /**
     * Create a new component instance.
     *
     * @param mixed $read
     */
    public function __construct(public Messageboard $messageboard, public $read = true)
    {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|\Closure|string
    {
        return view('components.forum.messageboard-item');
    }
}
