<?php

namespace App\Http\Livewire\Doctor;

use App\Models\Symptom;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class SymptomController extends Component
{
    use WithPagination;
    public $search = '';
    public $perPage = 5;
    public $sortAsc = true;
    public $sortField = 'name';
    public $symptomId;

    public $name;

    public $modal = false;
    public $modalEdit = false;

    protected $rules = ['name' => 'required'];

    public function addSymptom()
    {
        $this->validate();
        $symptom = Symptom::create([
            'name' => mb_strtolower($this->name),
            'slug' => Str::slug($this->name),
        ]);
        $this->reset(['name']);
        $this->render();
        $this->modal = false;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function edit(Symptom $symptom)
    {
        $this->symptomId = $symptom->id;
        $this->name = $symptom->name;
        $this->modalEdit = true;
    }

    public function update(Symptom $symptom)
    {
        $this->validate();
        if ($symptom->users->count() == 0) {
            $symptom->name = mb_strtolower($this->name);
            $symptom->slug = Str::slug($this->name);
            $symptom->save();
        }
        $this->reset(['name']);
        $this->modalEdit = false;
        $this->render();
    }

    public function delete(Symptom $symptom)
    {
        if ($symptom->users->count() == 0) {
            $symptom->delete();
        }}

    public function render()
    {
        $symptoms = Symptom::search($this->search)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->paginate($this->perPage);

        return view('livewire.doctor.symptom-controller', ['symptoms' => $symptoms])->layout('layouts.doctor');
    }
}
