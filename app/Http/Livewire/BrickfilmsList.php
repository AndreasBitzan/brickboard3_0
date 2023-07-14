<?php

namespace App\Http\Livewire;

use App\Http\Enums\ModerationStateEnum;
use App\Http\Enums\TopicTypeEnum;
use App\Models\Topic;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class BrickfilmsList extends Component
{
    use WithPagination;
    public $userId;

    public function getRowsQueryProperty()
    {
        $query = Topic::query()->where('topic_type_id', TopicTypeEnum::BRICKFILM->value);

        if (!Auth::check() || !auth()->user()->hasPermissionTo('topic moderation')) {
            if (Auth::check() && auth()->user()->moderation_state_id != ModerationStateEnum::APPROVED->value) {
                $query->where('moderation_state_id', ModerationStateEnum::APPROVED->value)
                    ->orWhere(function ($query) {
                        $query->where('user_id', auth()->id())
                            ->where('moderation_state_id', ModerationStateEnum::PENDING->value)
                            ->where('topic_type_id', TopicTypeEnum::BRICKFILM->value)
                        ;
                    })
                ;
            } else {
                $query->where('moderation_state_id', ModerationStateEnum::APPROVED->value);
            }
        }

        return $query->orderBy('sticky', 'desc')->orderBy('movie_created_at', 'desc')->orderBy('created_at', 'desc');
    }

    public function getRowsProperty()
    {
        return $this->rowsQuery->paginate(20);
    }

    public function render()
    {
        return view('livewire.brickfilms-list', ['brickfilms' => $this->rows]);
    }
}
