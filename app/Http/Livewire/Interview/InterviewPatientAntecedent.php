<?php

namespace App\Http\Livewire\Interview;

use App\Models\Antecedent;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class InterviewPatientAntecedent extends Component
{
    public $patient, $user_id;
    public $modal = false;
    public $modalEdit = false;
    public $antecedentEditId;
    public $name,$year,$observation,$antecedent_id;
    public $date;


    public function mount($user_id)
    {
        $this->user_id = $user_id;
        $this->patient = User::find($user_id);
        $this->date = Carbon::parse(now())->format('Y-m-d');
    }


    protected $rules = [
        'year' => 'required|numeric',
        'antecedent_id' => 'required'];


    public function abrir(){
        $this->date = Carbon::parse(now())->format('Y-m-d');
        $this->year = Carbon::parse(now())->format('Y');

        $this->modal = true;
    }

    public function addAntecedent(){
        $data = $this->validate();
        $antecedente = Antecedent::find($this->antecedent_id);
        $this->patient->antecedents()->attach($data['antecedent_id'],
        ['year' => $data['year'],
         'observation' => $this->observation,
         'date' => $this->date,
         'name' => $antecedente->name,
     ]);
 $this->modal = false;
 $this->resetValidation();
 $this->reset('name','year','observation','antecedent_id','date');
 $this->render();
    }


    public function edit($pivot)
    {
        $antecedentEdit = collect(\DB::select("SELECT * FROM antecedent_user WHERE id=$pivot"))->first();
        $this->antecedentEditId = $pivot;
        $this->antecedent_id = $antecedentEdit->antecedent_id;
        $this->name = $antecedentEdit->name;
        $this->year = $antecedentEdit->year;
        $this->date = $antecedentEdit->date;
        $this->date = Carbon::parse($antecedentEdit->date)->format('Y-m-d');
        $this->observation = $antecedentEdit->observation;
        $this->modalEdit = true;
    }

    public function update()
    {

       $this->validate();
        $antecedente = Antecedent::find($this->antecedent_id);
        DB::table('antecedent_user')->where('id', $this->antecedentEditId)->update(array(
            'year' => $this->year,
            'name' => $antecedente->name,
            'date' => $this->date,
            'antecedent_id' => $this->antecedent_id,
            'observation' => $this->observation,
        ));

        $this->modalEdit = false;
    }

    public function delete()
    {
        DB::table('antecedent_user')->where('id', $this->antecedentEditId)->delete();
        $this->modalEdit = false;
    }





    public function render()
    {
        $user = User::find($this->user_id);
        $this->patient = $user;
        $patient_antecedents = $user->antecedents;
        $antecedent_list = Antecedent::orderBy('name')->get();
        return view('livewire.interview.interview-patient-antecedent', [
            'user' => $user,
            'patient_antecedents' => $patient_antecedents,
            'antecedent_list' => $antecedent_list,
        ]);
    }
}
