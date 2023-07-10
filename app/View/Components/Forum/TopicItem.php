<?php

namespace App\View\Components\Forum;

use App\Models\Topic;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TopicItem extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public Topic $topic, public bool $read = true)
    {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|\Closure|string
    {
        return view('components.forum.topic-item');
    }
}
