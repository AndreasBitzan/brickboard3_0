<?php

namespace App\Http\Livewire;

use App\Models\MessageboardGroup;
use App\Models\ReadState;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ForumOverview extends Component
{
    public $messageboardGroups = [];

    public function mount()
    {
        $this->messageboardGroups = MessageboardGroup::all();
    }

    public function isRead($messageboardId)
    {
        if (!Auth::check()) {
            return true;
        }

        // TODO Query only approved topics so it does not show unread when no topic is there

        // TODO SUM UP ALL READ STATES OF THIS USER AND COMPARE TO POSTS COUNT HERE IN MESSAGEBOARD

        $highestReadstate = ReadState::where('user_id', auth()->id())
            ->where('messageboard_id', $messageboardId)
            ->orderBy('unread_posts_count', 'desc')->first()
        ;
        error_log(json_encode($highestReadstate));
        if (!$highestReadstate) {
            return false;
        }

        return 0 == $highestReadstate->unread_posts_count;
    }

    public function render()
    {
        return view('livewire.forum-overview');
    }
}
