<?php

namespace App\Http\Livewire;

use App\Http\Enums\ModerationStateEnum;
use App\Models\Messageboard;
use App\Models\ReadState;
use App\Models\Topic;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class ForumDetail extends Component
{
    use WithPagination;
    use Actions;
    public $messageboard;
    public $search;
    public $readStates = [];

    public function mount(Messageboard $messageboard)
    {
        $this->messageboard = $messageboard;
    }

    public function getRowsQueryProperty()
    {
        // TODO write DB Query with left join on readstates to make it sortable by unread
        $query = Topic::query()->where('topics.messageboard_id', $this->messageboard->id);

        if (!Auth::check() || !auth()->user()->hasPermissionTo('topic moderation')) {
            if (Auth::check() && auth()->user()->moderation_state_id != ModerationStateEnum::APPROVED->value) {
                $query->where('moderation_state_id', ModerationStateEnum::APPROVED->value)
                    ->orWhere(function ($query) {
                        $query->where('user_id', auth()->id())
                            ->where('moderation_state_id', ModerationStateEnum::PENDING->value)
                            ->where('topics.messageboard_id', $this->messageboard->id)
                        ;
                    })
                ;
            } else {
                $query->where('moderation_state_id', ModerationStateEnum::APPROVED->value);
            }
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

    public function markAsRead()
    {
        // Absolut geile Lösung
        $emptyTopics = Topic::where('messageboard_id', $this->messageboard->id)->whereDoesntHave('users', function ($subQuery) {
            return $subQuery->where('users.id', auth()->id());
        })->get();

        foreach ($emptyTopics as $topic) {
            ReadState::create([
                'messageboard_id' => $this->messageboard->id,
                'user_id' => auth()->id(),
                'topic_id' => $topic->id,
                'read_posts_count' => $topic->posts_count,
            ]);
        }

        $topics = auth()->user()->read_topics()->wherePivot('unread_posts_count', '>', 0)->get();

        // fuck read count, unread count is more important and now this can be done in one query, makes it performant
        ReadState::where('user_id', auth()->id())->whereIn('topic_id', $topics->pluck('id')->toArray())->update([
            'unread_posts_count' => 0,
        ]);

        $this->notification()->success(__('Themen als gelesen markiert'));
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
