<?php

namespace App\Http\Livewire\School;

use App\Models\School;
use Livewire\Component;

class SchoolList extends Component
{
    public $title, $university, $specialty, $year,$college,$number,$schools=[],$schoolId;
    public $openModal = false;

    protected $listeners = ['delete'=>'delete','render'];

    public function delete($schoolId){
        $school = School::find($schoolId);
        $school->delete();
    }

    public function edit(School $school)
    {
        $this->schoolId=$school->id;
        $this->title = $school->title;
        $this->specialty = $school->specialty;
        $this->university = $school->university;
        $this->college = $school->college;
        $this->year = $school->year;
        $this->number = $school->number;
        $this->openModal = true;
    }

    public function update(){
        $school = School::find($this->schoolId);
        $school->title = $this->title;
        $school->specialty = $this->specialty;
        $school->university = $this->university;
        $school->college = $this->college;
        $school->year = $this->year;
        $school->number = $this->number;
        $school->save();
        $this->openModal = false;
        session()->flash('success', 'School successfully updated.');
    }



    public function render()
    {
$this->schools = auth()->user()->schools;

        return view('livewire.school.school-list');
    }
}
