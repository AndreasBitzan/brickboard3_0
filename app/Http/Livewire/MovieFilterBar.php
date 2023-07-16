<?php

namespace App\Http\Livewire;

use App\Models\BrickfilmCategory;
use Livewire\Component;

class MovieFilterBar extends Component
{
    public $mainFilters = [];
    public $subFilters = [];
    public $chosenFilters = [];
    public $includes_peter = false;
    protected $queryString = ['chosenFilters'];

    public function mount()
    {
        $allFilters = BrickfilmCategory::where('visible', true)->orderBy('position', 'asc')->get();
        $this->mainFilters = $allFilters->where('main_category', true);
        $this->subFilters = $allFilters->where('main_category', false);
    }

    public function updatedChosenFilters($value)
    {
        $this->emitTo('brickfilms-list', 'refreshMovieList', $this->chosenFilters);
    }

    public function updatedIncludesPeter($value)
    {
        $this->emitTo('brickfilms-list', 'includesPeter', $this->includes_peter);
    }

    public function resetFilters()
    {
        $this->reset('chosenFilters', 'includes_peter');
        $this->emitTo('brickfilms-list', 'refreshMovieList', []);
    }

    public function render()
    {
        return view('livewire.movie-filter-bar');
    }
}
