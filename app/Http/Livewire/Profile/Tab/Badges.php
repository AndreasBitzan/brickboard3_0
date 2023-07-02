<?php

namespace App\Http\Livewire\Profile\Tab;

use App\Models\Badge;
use Livewire\Component;
use WireUi\Traits\Actions;

class Badges extends Component
{
    use Actions;
    public $user;

    public function getRowsQueryProperty()
    {
        $query = Badge::query()->leftJoin('badge_user', 'badges.id', 'badge_user.badge_id');

        if (!auth()->user() || auth()->id() != $this->user->id) {
            $query = $this->user->badges();
        }

        return $query->orderBy('position', 'asc')->orderBy('created_at', 'desc');
    }

    public function getRowsProperty()
    {
        return $this->rowsQuery->get();
    }

    public function setMainBadge(Badge $badge, $user_id = 0)
    {
        error_log(json_encode($badge));
        if (!auth()->user() || auth()->id() != $user_id) {
            return;
        }
        $this->dialog()->confirm([
            'title' => __('Badge auswählen?'),

            'description' => __('Willst du dieses Badge als Hauptbadge für dein Profil ausrüsten?'),

            'acceptLabel' => __('Ja, Badge aktivieren'),

            'rejectLabel' => __('Abbrechen'),

            'method' => 'performMainBadgeSetting',

            'params' => $badge,
        ]);
    }

    public function performMainBadgeSetting(Badge $badge)
    {
        $this->user->main_badge_id = $badge->id;
        $this->user->save();
        $this->notification()->success(__('Hauptbadge geändert!'));
        $this->emitTo('profile.user-image', 'refreshImage');
    }

    public function render()
    {
        error_log(count($this->rows));

        return view('livewire.profile.tab.badges', ['badges' => $this->rows]);
    }
}
