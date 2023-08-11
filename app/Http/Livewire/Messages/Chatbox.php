<?php

namespace App\Http\Livewire\Messages;

use App\Models\PrivatePost;
use App\Models\PrivateTopic;
use Livewire\Component;
use Livewire\WithPagination;

class Chatbox extends Component
{
    use WithPagination;
    public $private_topic;
    public $activeSlug;
    public $perPage = 10;
    public $content;

    protected $queryString = ['activeSlug' => ['as' => 'nachricht']];

    protected $listeners = ['changeActiveChat'];

    public function changeActiveChat(PrivateTopic $privateTopic)
    {
        if ($privateTopic && auth()->user()->can('view', $privateTopic)) {
            $this->private_topic = $privateTopic;
            $this->activeSlug = $privateTopic->slug;
            $this->dispatchBrowserEvent('messageSubmitted');
        }
    }

    public function getRowsQueryProperty()
    {
        // TODO check by moderation state

        return $this->private_topic->messages()->orderBy('created_at', 'desc')->with('author');
    }

    public function getRowsProperty()
    {
        return $this->rowsQuery->paginate($this->perPage);
    }

    public function loadMore()
    {
        $this->perPage += 10;
    }

    public function createMessage()
    {
        PrivatePost::create([
            'user_id' => auth()->id(),
            'content' => $this->content,
            'private_topic_id' => $this->private_topic->id,
        ]);

        $this->dispatchBrowserEvent('messageSubmitted');
    }

    public function scrollDown()
    {
        $this->dispatchBrowserEvent('messageSubmitted');
    }

    public function mount()
    {
        if (isset($this->activeSlug)) {
            $privateTopic = PrivateTopic::where('slug', $this->activeSlug)->with('messages')->first();
            if ($privateTopic && auth()->user()->can('view', $privateTopic)) {
                $this->private_topic = $privateTopic;
            }
        } else {
            // Todo test if this is working properly with multiple accounts
            $this->private_topic = PrivateTopic::whereHas('chatters', function ($query) {
                $query->where('user_id', auth()->id());
            })->latest()->first();
        }
    }

    public function render()
    {
        return view('livewire.messages.chatbox', ['messages' => $this->rows]);
    }
}
