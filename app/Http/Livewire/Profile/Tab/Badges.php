<?php

namespace App\Http\Livewire\Profile\Tab;

use App\Models\Badge;
use Livewire\Component;

class Badges extends Component
{
    public $user;

    public function getRowsQueryProperty()
    {
        $query = Badge::query()->leftJoin('badge_user', 'badges.id', 'badge_user.badge_id');

        return $query->orderBy('position', 'asc')->orderBy('created_at', 'desc');
    }

    public function getRowsProperty()
    {
        return $this->rowsQuery->get();
    }

    public function render()
    {
        error_log(count($this->rows));

        return view('livewire.profile.tab.badges', ['badges' => $this->rows]);
    }
}
