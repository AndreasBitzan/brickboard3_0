<?php

namespace App\Http\Livewire;

use App\Models\Reaction;
use App\Models\ReactionType;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ReactionContainer extends Component
{
    public $topic;
    public $reaction_types = [];

    public function hasReacted(ReactionType $reaction_type): bool
    {
        if (!Auth::check()) {
            return true;
        }

        return Reaction::where('user_id', auth()->id())->where('topic_id', $this->topic->id)->where('reaction_type_id', $reaction_type->id)->exists();
    }

    public function react(ReactionType $reaction_type)
    {
        if (!Auth::check()) {
            return;
        }

        if (!$this->hasReacted($reaction_type)) {
            Reaction::create([
                'user_id' => auth()->id(),
                'topic_id' => $this->topic->id,
                'reaction_type_id' => $reaction_type->id,
            ]);
        } else {
            $reaction = Reaction::where('user_id', auth()->id())->where('topic_id', $this->topic->id)->where('reaction_type_id', $reaction_type->id)->first();
            $reaction->delete();
        }
    }

    public function render()
    {
        $this->reaction_types = ReactionType::with(['reactions' => function ($query) {
            $query->where('topic_id', $this->topic->id);
        }])->orderBy('id', 'desc')->get();

        return view('livewire.reaction-container');
    }
}
