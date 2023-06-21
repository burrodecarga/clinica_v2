<?php

namespace App\Http\Livewire\Patient;

use App\Models\Surgery;
use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;


class PatientSurgery extends Component
{

    public $search;
    public $perPage = 5;
    public $sortAsc = true;
    public $sortField = 'name';
    public $surgeryId;
    public $name, $year, $surgery_id, $patient_surgeries, $patient;

    public $modal = false;

    protected $rules = ['name' => 'required', 'year' => 'required|numeric', 'surgery_id' => 'required'];

    public function mount(User $user)
    {
        $this->patient = $user;
        $this->patient_surgeries = $user->surgeries;
    }

    public function addModalSurgery($surgeryId)
    {
            $surgery = Surgery::find($surgeryId);
            $this->name = $surgery->name;
            $this->surgery_id = $surgery->id;
            $this->modal = true;
    }

    public function addSurgery()
    {
        $data = $this->validate();
        $this->patient->surgeries()->attach($data['surgery_id'], ['year' => $data['year']]);
        $this->modal = false;
        $this->reset(['name','year','search']);
        $this->patient_surgeries = $this->patient->surgeries()->get();
        $this->resetValidation();
        $this->render();

    }

    public function addNew()
    {
        $newSurgery = Surgery::create([
            'name' => mb_strtolower($this->search),
            'slug' => Str::slug($this->search),
        ]);
        $this->surgery = $newSurgery;
        $this->name = $newSurgery->name;
        $this->addModalSurgery($newSurgery->id);
    }




    public function render()
    {

        if ($this->search) {
            $surgeries = Surgery::search($this->search)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->paginate($this->perPage);

        } else {
            $surgeries = [];
        }

        return view('livewire.patient.patient-surgery',['surgeries'=>$surgeries]);
    }
}
