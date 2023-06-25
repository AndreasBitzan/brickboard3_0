<?php

namespace App\View\Components;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UserImage extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public User $user, public $zoom = false)
    {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|\Closure|string
    {
        return view('components.user-image');
    }
}
