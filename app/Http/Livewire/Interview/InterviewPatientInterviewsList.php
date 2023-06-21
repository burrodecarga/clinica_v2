<?php

namespace App\Http\Livewire\Interview;

use App\Models\User;
use Livewire\Component;

class InterviewPatientInterviewsList extends Component
{
    public $user_id,$gender, $userInterviews = [];
    public function mount($user_id)
    {
        $this->user_id = $user_id;

    }

    public function render()
    {

        $user = User::find($this->user_id);
        $this->userInterviews = $user->interviews;

        return view('livewire.interview.interview-patient-interviews-list', ['user_id' => $this->user_id]);
    }
}
