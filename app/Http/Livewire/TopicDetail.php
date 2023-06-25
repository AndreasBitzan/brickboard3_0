<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\WithSorting;
use App\Models\Post;
use App\Models\Topic;
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

    // protected $queryString = ['page'];

    public function mount()
    {
        Topic::where('id', $this->topic->id)->increment('view_count');
        $this->sortDirection = 'asc';

        // $this->gotoPage($this->rows->lastPage());
    }

    public function getRowsQueryProperty()
    {
        // TODO check by moderation state
        $query = Post::query()
            ->where('topic_id', $this->topic->id)
        ;

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
