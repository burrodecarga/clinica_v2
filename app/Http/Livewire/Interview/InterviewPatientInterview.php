<?php

namespace App\Http\Livewire\Interview;

use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class InterviewPatientInterview extends Component
{
    public $user_id,$interview_id,$gender,$patientName;
    public $date, $suspicion,$diagnosis;

    public function mount($user_id,$interview_id,$gender){
        $this->user_id = $user_id;
        $this->interview_id = $interview_id;
        $this->gender = $gender;
        $this->patientName = User::find($this->user_id)->name;
        $this->date = Carbon::parse(now())->format('Y-m-d');
     }

    public function render()
    {
        return view('livewire.interview.interview-patient-interview',['user_id'=>$this->user_id,
        'interview_id'=>$this->interview_id,
        'gender'=>$this->gender,
        'patientName'=>$this->patientName
    ]);
    }
}
