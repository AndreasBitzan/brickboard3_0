<?php

namespace App\Http\Livewire;

use App\Http\Enums\ModerationStateEnum;
use App\Models\Messageboard;
use App\Models\Topic;
use Livewire\Component;
use Livewire\WithPagination;

class ForumDetail extends Component
{
    use WithPagination;
    public $messageboard;
    public $search;

    public function mount(Messageboard $messageboard)
    {
        $this->messageboard = $messageboard;
    }

    public function getRowsQueryProperty()
    {
        // TODO FILTER BY MODERATION STATE
        $query = Topic::query()->where('messageboard_id', $this->messageboard->id);

        if (!auth()->user() || !auth()->user()->hasPermissionTo('topic moderation')) {
            $query->where('moderation_state_id', ModerationStateEnum::APPROVED->value);
        }

        return $query->orderBy('sticky', 'desc')->orderBy('created_at', 'desc');
    }

    public function getRowsProperty()
    {
        return $this->rowsQuery->paginate(3);
    }

    public function render()
    {
        return view('livewire.forum-detail', ['topics' => $this->rows]);
    }
}
