<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\WithSorting;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class MembersList extends Component
{
    use WithPagination;
    use WithSorting;

    public $admins = false;
    public $perPage = 40;
    public $search;

    public function getRowsQueryProperty()
    {
        // TODO check by moderation state
        $query = User::query()
            ->when($this->search && strlen($this->search) > 2, function ($query, $filter) {
                $query->where('name', 'like', '%'.$this->search.'%');
            })
        ;

        return $this->applySorting($query);
    }

    public function getRowsProperty()
    {
        return $this->rowsQuery->paginate($this->perPage);
    }

    public function loadMore()
    {
        $this->perPage += 40;
    }

    public function render()
    {
        return view('livewire.members-list', ['users' => $this->rows]);
    }
}
