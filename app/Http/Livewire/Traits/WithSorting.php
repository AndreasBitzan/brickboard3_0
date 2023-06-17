<?php

namespace App\Http\Livewire\Traits;

trait WithSorting
{
    public $sortField = 'created_at';

    public $sortDirection = 'desc';

    public function sortBy($field)
    {
        if ($this->sortField == $field) {
            $this->sortDirection = 'asc' === $this->sortDirection ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortField = $field;
    }

    public function applySorting($query)
    {
        return $query->orderBy($this->sortField, $this->sortDirection);
    }
}
