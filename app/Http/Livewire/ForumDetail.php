<?php

namespace App\Http\Livewire;

use App\Http\Enums\ModerationStateEnum;
use App\Models\Messageboard;
use App\Models\ReadState;
use App\Models\Topic;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ForumDetail extends Component
{
    use WithPagination;
    public $messageboard;
    public $search;
    public $readStates = [];

    public function mount(Messageboard $messageboard)
    {
        $this->messageboard = $messageboard;
    }

    public function getRowsQueryProperty()
    {
        // TODO FILTER BY MODERATION STATE
        $query = Topic::query()->where('topics.messageboard_id', $this->messageboard->id);

        if (!auth()->user() || !auth()->user()->hasPermissionTo('topic moderation')) {
            $query->where('moderation_state_id', ModerationStateEnum::APPROVED->value);
        }

        return $query->orderBy('sticky', 'desc')->orderBy('created_at', 'desc');
    }

    public function getRowsProperty()
    {
        return $this->rowsQuery->paginate(3);
    }

    public function isRead($topic_id)
    {
        if (!Auth::check()) {
            return true;
        }

        $readState = $this->readStates->where('topic_id', $topic_id)->first();
        if (!$readState) {
            return false;
        }

        return 0 == $readState->unread_posts_count;
    }

    public function render()
    {
        $topics = $this->rows;

        if (auth()->user()) {
            $this->readStates = ReadState::where('user_id', auth()->id())->whereIn('topic_id', $this->rows->pluck('id'))->get();
        }

        return view('livewire.forum-detail', ['topics' => $topics]);
    }
}
