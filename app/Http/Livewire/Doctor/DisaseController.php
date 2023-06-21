<?php

namespace App\Http\Livewire\Doctor;

use App\Models\Disase;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class DisaseController extends Component
{

    use WithPagination;
    public $search='';
    public $perPage=5;
    public $sortAsc=true;
    public $sortField = 'name';
    public $disaseId;

    public $name, $symptoms;

    public $modal = false;
    public $modalEdit = false;

    protected $rules = ['name' => 'required'];

    public function addDisase()
    {
        $this->validate();
        $disase = Disase::create([
            'name' => mb_strtolower($this->name),
            'slug' => Str::slug($this->name),
            'symptoms' => mb_strtolower($this->symptoms),
        ]);
        $this->reset(['name', 'symptoms']);
        $this->render();
        $this->modal = false;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function edit(Disase $disase){
        $this->disaseId = $disase->id;
              $this->name = $disase->name;
              $this->symptoms = $disase->symptoms;
              $this->modalEdit = true;
    }

    public function update(Disase $disase){
        $this->validate();
        if($disase->users->count()==0){
        $disase->name=mb_strtolower($this->name);
        $disase->slug = Str::slug($this->name);}
        $disase->symptoms=mb_strtolower($this->symptoms);
        $disase->save();
        $this->reset(['name', 'symptoms']);
        $this->modalEdit = false;
        $this->render();
    }

    public function delete(Disase $disase){
if($disase->users->count()==0){
      $disase->delete();
}


    }


    public function render()
    {
        $disases = Disase::search($this->search)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->paginate($this->perPage);

        return view('livewire.doctor.disase-controller', ['disases' => $disases])->layout('layouts.doctor');
    }
}
