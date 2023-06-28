<?php

namespace App\Http\Livewire;

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
