<?php

namespace App\Http\Livewire\Patient;

use App\Models\Interview;
use App\Models\Medicine;
use App\Models\User;
use Livewire\Component;

class PatientMedicine extends Component
{
    public $openModal = false;
    public $search;
    public $medicine_id, $dosage, $instruction;
    public $interview, $patient;

    protected $rules = ['medicine_id' => 'required', 'dosage' => 'required', 'instruction' => 'required'];

    public function mount(Interview $interview)
    {
        $this->interview = $interview;
        $this->patient = User::find($interview->patient_id);
    }

    public function add()
    {
        $data = $this->validate();
        $medicine = Medicine::find($data['medicine_id']);
        $patientId = $this->interview->patient_id;
        $medicine->users()->attach($patientId, [
            'dosage' => $data['dosage'],
            'instruction' => $data['instruction'],
            'interview_id'=>$this->interview->id
        ]);
        $this->openModal =false;

    }

    public function render()
    {
        $patient_medicines = $this->patient->medicines()->withPivot('dosage','instruction')->wherePivot('interview_id',$this->interview->id)->paginate(10);
        $search = '%' . $this->search . '%';
        $medicines = Medicine::orderBy('name')->where('name', 'like', $search)->paginate(4);
        return view('livewire.patient.patient-medicine', compact('medicines','patient_medicines'));
    }
}
