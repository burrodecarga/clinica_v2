<?php

namespace App\Http\Livewire\Interview;

use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class InterviewPatientSon extends Component
{
    public $user_id, $name, $birthdate, $gender = 'masculino', $userId;
    public $modal = false;
    public $modalEdit = false;

    public function mount($user_id)
    {
        $this->user_id = $user_id;
        $this->birthdate = Carbon::parse(now())->format('Y-m-d');
    }

    protected $rules = [
        'name' => 'required',
        'birthdate' => 'required',
        'gender' => 'required',
    ];

    public function addSon()
    {
        $this->validate();
        $padre = User::find($this->user_id);
        $num = $padre->sons->count() + 1;
        $hijo = User::create([
            'name' => $this->name,
            'birthdate' => $this->birthdate,
            'gender' => $this->gender,
            'address' => $padre->address,
            'phone' => $padre->phone,
            'email' => 'hijo_' . $padre->id . '_' . $num . '_' . $padre->email,
            'password' => 'password',
        ]);

        $padre->sons()->attach($hijo);
        $this->reset('name');
        $this->modal = false;
    }

    public function edit(User $user)
    {
        $this->name = $user->name;
        $this->gender = $user->gender;
        $this->birthdate = Carbon::parse($user->birthdate)->format('Y-m-d');
        $this->userId = $user->id;
        $this->modalEdit = true;
    }

    public function update($userId)
    {
        $this->validate();
        $user = User::find($userId);
        $user->name = $this->name;
        $user->birthdate = $this->birthdate;
        $user->gender = $this->gender;
        $this->reset('name');
        $user->save();
        $this->modalEdit = false;
    }

    public function delete($hijo_id)
    {

        $hijo = User::find($hijo_id);
        $padre = User::find($this->user_id);
        $padre->sons()->detach($hijo->id);
        $this->modalEdit = false;
    }
    public function render()
    {
        $user = User::find($this->user_id);
        $sons = $user->sons;
        return view('livewire.interview.interview-patient-son', ['sons' => $sons, 'user' => $user]);
    }
}
