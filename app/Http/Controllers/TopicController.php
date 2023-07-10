<?php

namespace App\Http\Controllers;

use App\Models\Messageboard;
use App\Models\ReadState;
use App\Models\Topic;
use Illuminate\Support\Facades\Auth;

class TopicController extends Controller
{
    public function show(Messageboard $messageboard, Topic $topic)
    {
        if (Auth::check()) {
            ReadState::updateOrCreate(
                ['messageboard_id' => $messageboard->id, 'topic_id' => $topic->id, 'user_id' => auth()->id()],
                ['unread_posts_count' => 0, 'read_posts_count' => $topic->posts_count]
            );
        }

        return view('topic-detail')->with(['messageboard' => $messageboard, 'topic' => $topic]);
    }
}
