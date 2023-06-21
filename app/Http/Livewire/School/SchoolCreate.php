<?php

namespace App\Http\Livewire\School;

use App\Models\School;
use Livewire\Component;

class SchoolCreate extends Component
{
    public $openModal = false;
    public $schools = [];
    public $title, $specialty, $university, $year, $college, $number;

    protected $rules = [
        'title' => 'required',
        'specialty' => 'required',
        'university' => 'required',
        'year' => 'required',
        'college' => 'required',
        'number' => 'required',
    ];

    public function addSchool()
    {
        $data = $this->validate();
        School::create([
            'specialty' => $data['specialty'],
            'title' => $data['title'],
            'university' => $data['university'],
            'year' => $data['year'],
            'college' => $data['college'],
            'number' => $data['number'],
            'user_id' => auth()->user()->id,
        ]);
        $this->openModal = false;
        $this->reset('title', 'specialty', 'university', 'year', 'college', 'number');
        $this->emitTo('school.school-list', 'render');
    }


    public function render()
    {
        return view('livewire.school.school-create');
    }
}
