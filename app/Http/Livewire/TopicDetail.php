<?php

namespace App\Http\Livewire;

use App\Http\Enums\ModerationStateEnum;
use App\Http\Livewire\Traits\WithSorting;
use App\Models\Post;
use App\Models\Topic;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class TopicDetail extends Component
{
    use WithPagination;
    use WithSorting;
    use Actions;

    public $topic;
    public $messageboard;
    public $perPage = 10;
    public $edit = false;
    public $content = '';

    protected $listeners = ['refreshPostList' => '$refresh'];
    // protected $queryString = ['page'];

    public function mount()
    {
        Topic::where('id', $this->topic->id)->increment('view_count');
        $this->sortDirection = 'asc';

        // $this->gotoPage($this->rows->lastPage());
    }

    public function followTopic()
    {
        if ($this->isFollower()) {
            $this->topic->followers()->detach(auth()->id());
            $this->notification()->info(__('Benachrichtigungen deaktiviert'));
            // $this->emit('refreshPostList');
        } else {
            $this->topic->followers()->attach(auth()->id(), ['created_at' => now('Europe/Vienna')]);
            $this->notification()->success(__('Benachrichtigungen aktiv'));
            // $this->emit('refreshPostList');
        }
    }

    public function isFollower(): bool
    {
        return auth()->user()->followed_topics()->where('topic_id', $this->topic->id)->exists();
    }

    public function deleteTopic()
    {
        $this->dialog()->confirm([
            'title' => __('Bist du sicher?'),
            'description' => __('Topic wirklich löschen?'),
            'icon' => 'warning',
            'acceptLabel' => __('Ja, löschen'),
            'rejectLabel' => __('Abbrechen'),
            'method' => 'performDelete',
        ]);
    }

    public function performDelete()
    {
        if (auth()->user()->hasPermissionTo('delete topic')) {
            $this->topic->delete();
            $this->redirect(route('forum.detail', $this->messageboard));
        } else {
            $this->notification()->error(__('Berechtigung fehlt'));
        }
    }

    public function pinTopic()
    {
        if (false == $this->topic->sticky) {
            $this->topic->sticky = true;
            $this->notification()->info(__('Thema angepinnt'));
        } else {
            $this->topic->sticky = false;
            $this->notification()->info(__('Thema entpinnt'));
        }
        $this->topic->save();
    }

    public function lockTopic()
    {
        if (false == $this->topic->locked) {
            $this->topic->locked = true;
            $this->notification()->info(__('Thema gesperrt'));
        } else {
            $this->topic->locked = false;
            $this->notification()->info(__('Thema entsperrt'));
        }
        $this->topic->save();
    }

    public function approveTopic()
    {
        $this->topic->moderation_state_id = ModerationStateEnum::APPROVED->value;
        foreach ($this->topic->posts as $post) {
            $post->moderation_state_id = ModerationStateEnum::APPROVED->value;
            $post->save();
        }
        $this->notification()->info(__('Thema freigeschalten'));
        $this->topic->save();
        $this->emitSelf('refreshPostList');
    }

    public function getRowsQueryProperty()
    {
        $query = Post::query()
            ->where('topic_id', $this->topic->id)
        ;

        if (!Auth::check() || !auth()->user()->hasPermissionTo('topic moderation')) {
            if (Auth::check() && auth()->user()->moderation_state_id != ModerationStateEnum::APPROVED->value) {
                $query->where('moderation_state_id', ModerationStateEnum::APPROVED->value)
                    ->orWhere(function ($query) {
                        $query->where('user_id', auth()->id())
                            ->where('moderation_state_id', ModerationStateEnum::PENDING->value)
                            ->where('topic_id', $this->topic->id)
                        ;
                    })
                ;
            } else {
                $query->where('moderation_state_id', ModerationStateEnum::APPROVED->value);
            }
        }

        return $this->applySorting($query);
    }

    public function getRowsProperty()
    {
        return $this->rowsQuery->paginate($this->perPage);
    }

    public function createPost()
    {
        if ($this->content && strlen(strip_tags($this->content)) > 0) {
            Post::create([
                'user_id' => auth()->id(),
                'content' => $this->content,
                'topic_id' => $this->topic->id,
                'messageboard_id' => $this->messageboard->id,
                'moderation_state_id' => auth()->user()->moderation_state_id,
            ]);
            $this->notification()->success(__('Post erfolgreich erstellt!'));
        }
        $this->reset('content', 'edit');
    }

    public function render()
    {
        return view('livewire.topic-detail', ['posts' => $this->rows]);
    }
}
