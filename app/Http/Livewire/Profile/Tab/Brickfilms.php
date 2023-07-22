<?php

namespace App\Http\Livewire\Profile\Tab;

use App\Http\Enums\ModerationStateEnum;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Brickfilms extends Component
{
    use WithPagination;

    public $user;

    public function getRowsQueryProperty()
    {
        $query = $this->user->movies();

        if (!Auth::check() || !auth()->user()->hasPermissionTo('topic moderation')) {
            if (Auth::check() && auth()->user()->moderation_state_id != ModerationStateEnum::APPROVED->value) {
                $query->where('moderation_state_id', ModerationStateEnum::APPROVED->value)
                    ->orWhere(function ($query) {
                        $query->where('user_id', auth()->id())
                            ->where('moderation_state_id', ModerationStateEnum::PENDING->value)
                        ;
                    })
                ;
            } else {
                $query->where('moderation_state_id', ModerationStateEnum::APPROVED->value);
            }
        }

        return $query->orderBy('movie_created_at', 'desc');
    }

    public function getRowsProperty()
    {
        return $this->rowsQuery->paginate(18, ['*'], 'brickfilms');
    }

    public function render()
    {
        return view('livewire.profile.tab.brickfilms', ['brickfilms' => $this->rows]);
    }
}
