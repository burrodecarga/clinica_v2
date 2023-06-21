<?php

namespace App\Http\Livewire\Patient;

use App\Models\File;
use App\Models\Interview;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;

class PatientFile extends Component
{
    use WithFileUploads;

    public $openModal, $file,$observation,$name;

    protected $rules = [
        'file'=>['required','mimes:png,jpg,jpeg,pdf']
    ];

    public function add(){
        $this->validate();
        $file = new File();
        $file->name = $this->name;
        $file->extension = $this->file->extension();
        $file->url = 'storage/'.$this->file->store('archivos','public');
        $file->observation = $this->observation;
        $file->save();
        $this->openModal = false;
        $this->interview->files()->attach($file->id,['user_id'=>$this->interview->patient_id]);
        $intId = $this->interview->id;
        $this->interview = Interview::find($intId);
    }



    public function mount(Interview $interview)
    {
        $this->interview = $interview;
    }


    public function render()
    {
        $patient_files =$this->interview->files;
        return view('livewire.patient.patient-file',compact('patient_files'));
    }
}
