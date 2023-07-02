<?php

namespace App\Http\Livewire\Profile\Tab;

use App\Http\Enums\ModerationStateEnum;
use App\Models\Topic;
use Livewire\Component;
use Livewire\WithPagination;

class Posts extends Component
{
    use WithPagination;
    public $user;

    public function getRowsQueryProperty()
    {
        $query = Topic::query()->where('user_id', $this->user->id);

        if (!auth()->user() || !auth()->user()->hasPermissionTo('topic moderation')) {
            $query->where('moderation_state_id', ModerationStateEnum::APPROVED->value);
        }

        return $query->orderBy('sticky', 'desc')->orderBy('created_at', 'desc');
    }

    public function getRowsProperty()
    {
        return $this->rowsQuery->paginate(2, ['*'], 'posts');
    }

    public function render()
    {
        return view('livewire.profile.tab.posts', ['topics' => $this->rows]);
    }
}
