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
    public $activeChat;

    public function mount()
    {
        $this->activeChat = PrivateTopic::whereHas('chatters', function ($query) {
            $query->where('user_id', auth()->id());
        })->latest()->first();
    }

    public function getRowsQueryProperty()
    {
        // TODO check by moderation state
        $query = auth()->user()->chats();

        return $this->applySorting($query);
    }

    public function openChat(PrivateTopic $privateTopic)
    {
        $this->emit('changeActiveChat', $privateTopic);
        $this->activeChat = $privateTopic;
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
