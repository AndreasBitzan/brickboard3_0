<?php

namespace App\Http\Livewire;

use App\Http\Enums\ModerationStateEnum;
use App\Http\Enums\TopicTypeEnum;
use App\Models\ReadState;
use App\Models\Topic;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class BrickfilmsList extends Component
{
    use WithPagination;
    public $userId;
    public $readStates = [];
    public $chosenFilters = [];
    public $includes_peter = false;

    protected $queryString = ['chosenFilters'];

    protected $listeners = ['refreshMovieList', 'includesPeter'];

    public function refreshMovieList($filters)
    {
        $this->resetPage();
        $this->chosenFilters = $filters;
    }

    public function includesPeter($value)
    {
        $this->includes_peter = $value;
    }

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

        if (count($this->chosenFilters) > 0) {
            $query->whereHas('brickfilm_categories', function ($query) {
                $query->whereIn('id', $this->chosenFilters);
            });
        }
        $query->when($this->includes_peter, function ($query) {
            $query->where('includes_peter', true);
        });

        return $query->orderBy('sticky', 'desc')->orderBy('movie_created_at', 'desc')->orderBy('created_at', 'desc');
    }

    public function isRead(Topic $topic)
    {
        if (!Auth::check()) {
            return true;
        }

        $readState = $this->readStates->where('topic_id', $topic->id)->first();
        if (!$readState) {
            return false;
        }

        return 0 == $readState->unread_posts_count;
    }

    public function getRowsProperty()
    {
        return $this->rowsQuery->with('brickfilm_categories')->paginate(20);
    }

    public function render()
    {
        $topics = $this->rows;

        error_log('BRICKFILMSLIST');
        error_log(json_encode($this->chosenFilters));

        if (auth()->user()) {
            $this->readStates = ReadState::where('user_id', auth()->id())->whereIn('topic_id', $this->rows->pluck('id'))->get();
        }

        return view('livewire.brickfilms-list', ['brickfilms' => $topics]);
    }
}
