<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\WithSorting;
use App\Models\PrivateTopic;
use Livewire\Component;
use Livewire\WithPagination;

class ChatList extends Component
{
    use WithPagination;
    use WithSorting;

    public function getRowsQueryProperty()
    {
        // TODO check by moderation state
        $query = PrivateTopic::query()
            ->where('user_id', auth()->id())
        ;

        return $this->applySorting($query);
    }

    public function getRowsProperty()
    {
        return $this->rowsQuery->paginate(10);
    }

    public function render()
    {
        return view('livewire.chat-list', ['private_topics' => $this->rows]);
    }
}
