<?php

namespace App\View\Components;

use App\Models\Topic;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BrickfilmItem extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public Topic $topic, public bool $read)
    {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|\Closure|string
    {
        return view('components.brickfilm-item');
    }
}
