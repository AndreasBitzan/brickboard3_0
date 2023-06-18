<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\WithSorting;
use App\Models\Messageboard;
use App\Models\Topic;
use Livewire\Component;
use Livewire\WithPagination;

class ForumDetail extends Component
{
    use WithPagination;
    use WithSorting;

    public $messageboard;
    public $search;

    public function mount(Messageboard $messageboard)
    {
        $this->messageboard = $messageboard;
    }

    public function getRowsQueryProperty()
    {
        $query = Topic::query()->where('messageboard_id', $this->messageboard->id);

        return $this->applySorting($query);
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
