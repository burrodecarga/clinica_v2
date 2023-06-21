<?php

namespace App\Http\Livewire\Patient;

use App\Models\Specialty;
use Livewire\Component;
use Livewire\WithPagination;

class PatientSpecialty extends Component
{

    use WithPagination;
    public $search1;


    public function selectDate($doctorId,$specialtyId){
        $this->emitTo('patient.patient-date','selectDate',$doctorId,$specialtyId);
    }


    public function render()
    {
        $search = '%'.$this->search1.'%';
        $specialties = Specialty::orderBy('name')->where('name','like',$search)->paginate(10);

        return view('livewire.patient.patient-specialty',['specialties'=>$specialties]);
    }
}
