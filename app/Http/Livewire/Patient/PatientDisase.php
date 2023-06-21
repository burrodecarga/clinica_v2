<?php

namespace App\Http\Livewire\Patient;

use App\Models\Disase;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Component;

class PatientDisase extends Component
{
    public $search;
    public $perPage = 5;
    public $sortAsc = true;
    public $sortField = 'name';
    public $disaseId;
    public $name, $year, $disase_id, $patient_disases, $patient;
    public $inherited=false,$deceased=false,$condition,$observation;
    public $modal = false;
    public $modalView = false;


    protected $rules = [
    'name' => 'required',
    'year' => 'required|numeric',
    'inherited'=>'required',
    'deceased'=>'required',
    'condition'=>'required',
    'disase_id' => 'required'];

    public function mount(User $user)
    {
        $this->patient = $user;
        $this->patient_disases = $user->disases;
    }

    public function addModalDisase($disaseId)
    {
            $disase = Disase::find($disaseId);
            $this->name = $disase->name;
            $this->disase_id = $disase->id;
            $this->modal = true;
    }

    public function addDisase()
    {
        $data = $this->validate();
        $this->patient->disases()->attach($data['disase_id'], ['year' => $data['year'],'condition'=>$data['condition'],'deceased'=>$data['deceased'],'inherited'=>$data['inherited'],'observation'=>$this->observation]);
        $this->modal = false;
        $this->reset(['name','year','search','inherited']);
        $this->patient_disases = $this->patient->disases()->get();
        $this->resetValidation();
        $this->render();

    }

    public function addNew()
    {
        $newDisase = Disase::create([
            'name' => mb_strtolower($this->search),
            'slug' => Str::slug($this->search),
            'symptoms' => '',
        ]);
        $this->disase = $newDisase;
        $this->name = $newDisase->name;
        $this->addModalDisase($newDisase->id);
    }


    public function view(Disase $disase){
        $pivote =
        $disasePivot = DB::table('disase_user')->where('disase_user.id', $pivote)->first();
        $disase = Disase::find($disasePivot->disase_id);
         $this->name = $disase->name;
         $this->year = $disasePivot->year;
         $this->inherited = $disasePivot->inherited;
         $this->deceased = $disasePivot->deceased;
         $this->condition = $disasePivot->condition;
         $this->observation = $disasePivot->observation;
         $this->disase_id = $disasePivot->disase_id;
         $this->modal=true;
         }

         public function del($pivote){
            if($pivote){
                $disasePivot = DB::table('disase_user')->where('disase_user.id', $pivote)->delete();
                $this->patient_disases = $this->patient->disases;
            }
         }



    public function render()
    {
        if ($this->search) {
            $disases = Disase::search($this->search)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->paginate($this->perPage);
            $this->patient_disases = $this->patient->disases;

        } else {
            $disases = [];
        }



        return view('livewire.patient.patient-disase', ['disases' => $disases]);
    }
}
