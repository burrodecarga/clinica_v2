<?php

namespace App\Http\Livewire\Tool;

use App\Models\Pathology;
use Livewire\Component;

class DisaseSearch extends Component
{
    public $search;
    public $perPage = 5;

    public function render()
    {
        if ($this->search) {
            $disases = Pathology::search($this->search)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->paginate($this->perPage);
            $this->patient_disases = $this->patient->disases;

        } else {
            $disases = [];
        }
        return view('livewire.tool.disase-search');
    }
}
