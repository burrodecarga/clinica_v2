<?php

namespace App\Http\Livewire\Interview;

use App\Models\Disase;
use App\Models\Pathology;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class InterviewPatientDisases extends Component
{

    use WithPagination;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public $user_id, $modal = false, $modalEdit = false,$search="vehic",$total;
    public $name, $year, $disase_id, $doctor, $doctor_id, $patient, $patient_disase;
    public $inherited = false, $deceased = false, $condition, $observation, $patient_disase_id;
    public $edicion = false;
    public $disaseEditId;

    protected $rules = [
        'year' => 'required|numeric',
        'inherited' => 'required',
        'deceased' => 'required',
        'condition' => 'required',
        'disase_id' => 'required'];

    public function addDisase()
    {
        $data = $this->validate();
        $enfermedad = Disase::find($data['disase_id']);

        $this->patient->disases()->attach($data['disase_id'],
               ['year' => $data['year'],
                'condition' => $data['condition'],
                'deceased' => $data['deceased'],
                'inherited' => $data['inherited'],
                'observation' => $this->observation,
                'doctor' => auth()->user()->name,
                'doctor_id' => auth()->user()->id,
                'name' => $enfermedad->name,
            ]);
        $this->modal = false;
        $this->resetValidation();
        $this->reset('name','year','condition','deceased','inherited','observation','disase_id');
        $this->render();
    }

    public function edit($pivot)
    {
        $disaseEdit = collect(\DB::select("SELECT * FROM disase_user WHERE id=$pivot"))->first();
        $this->disaseEditId = $pivot;
        $this->name = $disaseEdit->name;
        $this->year = $disaseEdit->year;
        $this->inherited = $disaseEdit->inherited;
        $this->deceased = $disaseEdit->deceased;
        $this->condition = $disaseEdit->condition;
        $this->observation = $disaseEdit->observation;
        $this->modalEdit = true;

    }

    public function update()
    {
        DB::table('disase_user')->where('id', $this->disaseEditId)->update(array(
            'year' => $this->year,
            'condition' => $this->condition,
            'inherited' => $this->inherited,
            'deceased' => $this->deceased,
            'observation' => $this->observation,
        ));

        $this->modalEdit = false;
    }

    public function delete()
    {
        DB::table('disase_user')->where('id', $this->disaseEditId)->delete();
        $this->modalEdit = false;
    }

    public function mount($user_id)
    {
        $this->user_id = $user_id;
    }

    public function render()
    {
        $user = User::find($this->user_id);
        $this->patient = $user;
        $patient_disases = $user->disases;
        $search = '%' . $this->search . '%';
//$disase_list = Disase::orderBy('name')->get();
$disase_list = Pathology::orderBy('name')->where('name', 'like', $search)
->paginate(250);

$this->total = Pathology::orderBy('name')->where('name', 'like', $search)
->count();


        return view('livewire.interview.interview-patient-disases',
            ['user' => $user, 'patient_disases' => $patient_disases, 'disase_list' => $disase_list]);
    }
}
