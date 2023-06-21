<?php

namespace App\Http\Livewire\Doctor;

use App\Models\Antecedent;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class AntecedentController extends Component
{
    use WithPagination;
    public $search = '';
    public $perPage = 5;
    public $sortAsc = true;
    public $sortField = 'name';
    public $antecedentId;

    public $name, $gender, $type, $priority, $slug, $description;

    public $modal = false;
    public $modalEdit = false;

    protected $rules = [
        'name' => 'required',
        'gender' => 'required',
        'type' => 'required',
        'priority' => 'required'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function addAntecedent()
    {
        $this->validate();
        $antecedent = Antecedent::create([
            'name' => mb_strtolower($this->name),
            'type' => mb_strtolower($this->type),
            'priority' => mb_strtolower($this->priority),
            'gender' => mb_strtolower($this->gender),
            'slug' => Str::slug($this->name),
            'description' => mb_strtolower($this->description),
        ]);
$this->reset(['name', 'type', 'priority', 'gender', 'description']);

        $this->render();
        $this->modal = false;
    }

    public function edit(Antecedent $antecedent)
    {
        $this->antecedentId = $antecedent->id;
        $this->gender = $antecedent->gender;
        $this->priority = $antecedent->priority;
        $this->type = $antecedent->type;
        $this->name = $antecedent->name;
        $this->description = $antecedent->description;
        $this->modalEdit = true;
    }

    public function update(Antecedent $antecedent)
    {
        $this->validate();
        if ($antecedent->users->count()==0) {
            $antecedent->name = mb_strtolower($this->name);
            $antecedent->slug = Str::slug($this->name);}
        $antecedent->description = mb_strtolower($this->description);
        $antecedent->type = mb_strtolower($this->type);
        $antecedent->priority = mb_strtolower($this->priority);
        $antecedent->gender = mb_strtolower($this->gender);
        $antecedent->save();
        $this->reset(['name','type','gender','priority', 'description']);
        $this->modalEdit = false;
        $this->render();
    }

    public function delete(Antecedent $antecedent)
    {
        if ($antecedent->users->count()==0) {
            $antecedent->delete();}
    }


    public function render()
    {

        $antecedents = Antecedent::search($this->search)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->paginate($this->perPage);

        return view('livewire.doctor.antecedent-controller', ['antecedents' => $antecedents])->layout('layouts.doctor');
    }
}
