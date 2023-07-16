<?php

namespace App\Http\Livewire;

use App\Http\Enums\ModerationStateEnum;
use App\Models\MovieRole;
use App\Models\User;
use Livewire\Component;

class AddAuthorsModal extends Component
{
    public $authorModal = false;
    public $showSuggestions = false;
    public $suggestionList = [];
    public $movieRoles = [];
    public $chosenUser;
    public $chosenRole = 1;
    public $search = '';

    protected $listeners = ['openAuthorsModal'];

    protected $rules = ['chosenUsers.*.role' => 'nullable'];

    // protected $rules

    public function mount()
    {
        $this->movieRoles = MovieRole::all();
    }

    public function openAuthorsModal()
    {
        $this->authorModal = true;
    }

    public function updatedSearch($value)
    {
        if (strlen($value) > 2) {
            $this->suggestionList = User::where('moderation_state_id', ModerationStateEnum::APPROVED->value)->where('name', 'like', '%'.strtolower($value).'%')->get();
            if (count($this->suggestionList) > 0) {
                $this->showSuggestions = true;
            }
        } else {
            $this->showSuggestions = false;
        }
    }

    public function addToList($userId)
    {
        $this->chosenUser = $this->suggestionList->where('id', $userId)->first();
        $this->reset('showSuggestions', 'search');
    }

    public function resetAll()
    {
        $this->reset('authorModal', 'showSuggestions', 'suggestionList', 'chosenUser', 'search');
    }

    public function addToMovie()
    {
        $this->emitTo('movie-creator', 'addAuthors', $this->chosenUser, $this->chosenRole);
        $this->resetAll();
    }

    public function render()
    {
        return view('livewire.add-authors-modal');
    }
}
