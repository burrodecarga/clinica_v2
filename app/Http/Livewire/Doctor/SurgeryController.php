<?php

namespace App\Http\Livewire\Doctor;

use App\Models\Surgery;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class SurgeryController extends Component
{
    use WithPagination;
    public $search = '';
    public $perPage = 5;
    public $sortAsc = true;
    public $sortField = 'name';
    public $surgeryId;

    public $name, $description;

    public $modal = false;
    public $modalEdit = false;

    protected $rules = ['name' => 'required'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function addSurgery()
    {
        $this->validate();
        $surgery = Surgery::create([
            'name' => mb_strtolower($this->name),
            'slug' => Str::slug($this->name),
            'description' => mb_strtolower($this->description),
        ]);
        $this->reset(['name', 'description']);
        $this->render();
        $this->modal = false;
    }

    public function edit(Surgery $surgery)
    {
        $this->surgeryId = $surgery->id;
        $this->name = $surgery->name;
        $this->description = $surgery->description;
        $this->modalEdit = true;
    }

    public function update(Surgery $surgery)
    {
        $this->validate();
        if ($surgery->users->count()==0) {
            $surgery->name = mb_strtolower($this->name);
            $surgery->slug = Str::slug($this->name);}
        $surgery->description = mb_strtolower($this->description);
        $surgery->save();
        $this->reset(['name', 'description']);
        $this->modalEdit = false;
        $this->render();
    }

    public function delete(Surgery $surgery)
    {
        if ($surgery->users->count()==0) {
            $surgery->delete();}
    }

    public function render()
    {

        $surgeries = Surgery::search($this->search)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->paginate($this->perPage);
        return view('livewire.doctor.surgery-controller', ['surgeries' => $surgeries])->layout('layouts.doctor');
    }
}
