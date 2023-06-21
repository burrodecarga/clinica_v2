<?php

namespace App\Http\Livewire\Interview;

use App\Models\Surgery;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class InterviewPatientSurgeries extends Component
{

    public $user_id,$surgery_id,$name,$year,$type,$observation;
    public $patient;
    public $modal = false;
    public $modalEdit = false;
    public $surgeryEditId;

    public function mount($user_id)
    {
        $this->user_id = $user_id;
        $this->patient = User::find($user_id);
    }

    protected $rules = [
        'year' => 'required|numeric',
        'type' => 'required',
        'surgery_id' => 'required'];

        public function addSurgery(){
            $data = $this->validate();
            $cirugia = Surgery::find($this->surgery_id);
            $this->patient->surgeries()->attach($data['surgery_id'],
            ['year' => $data['year'],
             'type' => $data['type'],
             'observation' => $this->observation,
             'name' => $cirugia->name,
         ]);
     $this->modal = false;
     $this->resetValidation();
     $this->reset('name','year','type','observation','surgery_id');
     $this->render();
        }


        public function edit($pivot)
    {
        $surgeryEdit = collect(\DB::select("SELECT * FROM surgery_user WHERE id=$pivot"))->first();
        $this->surgeryEditId = $pivot;
        $this->name = $surgeryEdit->name;
        $this->year = $surgeryEdit->year;
        $this->type = $surgeryEdit->type;
        $this->observation = $surgeryEdit->observation;
        $this->modalEdit = true;
    }


    public function update()
    {
        DB::table('surgery_user')->where('id', $this->surgeryEditId)->update(array(
            'year' => $this->year,
            'name' => $this->name,
            'type' => $this->type,
            'observation' => $this->observation,
        ));
        $this->modalEdit = false;
    }

    public function delete()
    {
        DB::table('surgery_user')->where('id', $this->surgeryEditId)->delete();
        $this->modalEdit = false;
    }


    public function render()
    {
        $user = User::find($this->user_id);
        $this->patient = $user;
        $patient_surgeries = $user->surgeries;
        $surgeries_list = Surgery::orderBy('name')->get();
        return view('livewire.interview.interview-patient-surgeries', [
            'user' => $user,
            'patient_surgeries' => $patient_surgeries, 'surgeries_list' => $surgeries_list,
        ]);
    }
}
