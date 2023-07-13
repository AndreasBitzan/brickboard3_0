<?php

namespace App\Http\Livewire;

use App\Models\Messageboard;
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

    // Complex topic that might be necessary to be tweaked in the future
    public function isRead(Messageboard $messageboard)
    {
        // Abort mission, no user signed in
        if (!Auth::check()) {
            return true;
        }

        // IMPORTANT NOTE: Messageboard will only count the number of topics within a board now
        // if we do not have the same amount of readstates as topcis, there is a readstate missing so unread, using smaller than for moderation states
        if (ReadState::where('user_id', auth()->id())->where('messageboard_id', $messageboard->id)->count() < $messageboard->topics_count) {
            return false;
        }

        // If we find a readstate with unreadposts count > 0 , then also unread
        $highestReadstate = ReadState::where('user_id', auth()->id())
            ->where('messageboard_id', $messageboard->id)
            ->orderBy('unread_posts_count', 'desc')->first()
        ;
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
