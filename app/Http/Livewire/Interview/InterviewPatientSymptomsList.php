<?php

namespace App\Http\Livewire\Interview;

use App\Models\Interview;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class InterviewPatientSymptomsList extends Component
{
    use WithPagination;

    public $user, $symptomsList = [];

    protected $listeners = ['newList' => 'render'];

    public function mount($user_id, $interview_id)
    {
        $this->user_symptoms_id = $user_id;
        $this->user = User::find($user_id);
        $this->interview = Interview::find($interview_id);

    }

    public function render()
    {
        $this->symptomsList = $this->interview->symptoms;
        return view('livewire.interview.interview-patient-symptoms-list');
    }
}
