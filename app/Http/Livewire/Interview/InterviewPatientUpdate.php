<?php

namespace App\Http\Livewire\Interview;

use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class InterviewPatientUpdate extends Component
{
    public $user_id, $cedula, $name, $gender, $phone, $birthdate, $email, $address;

    protected $rules = [
        'cedula' => 'required',
        'name' => 'required',
        'gender' => 'required',
        'birthdate' => 'required',
        'phone' => 'required',
        'address' => 'required',
    ];

    public function mount($user_id)
    {
        $this->user_id = $user_id;
        $user = User::find($this->user_id);
        $this->cedula = $user->cedula;
        $this->name = $user->name;
        $this->gender = $user->gender;
        $this->phone = $user->phone;
        //$this->birthdate = $user->birthdate;
        $this->email = $user->email;
        $this->address = $user->address;
        $this->birthdate = Carbon::parse($user->birthdate)->format('Y-m-d');
    }

    public function update()
    {
        $data = $this->validate();
        $user = User::find($this->user_id);
        $user->cedula = $this->cedula;
        $user->name = $this->name;
        $user->gender = $this->gender;
        $user->phone = $this->phone;
        $user->birthdate = $this->birthdate;
        $user->address = $this->address;
        $user->save();

    }

    public function render()
    {
        $user = User::find($this->user_id);
        return view('livewire.interview.interview-patient-update', ['user' => $user]);
    }
}
