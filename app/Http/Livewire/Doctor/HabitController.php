<?php

namespace App\Http\Livewire\Doctor;

use App\Models\Habit;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class HabitController extends Component
{
    use WithPagination;
    public $search = '';
    public $perPage = 5;
    public $sortAsc = true;
    public $sortField = 'name';
    public $habitId;

    public $name, $type, $description;

    public $modal = false;
    public $modalEdit = false;

    protected $rules = [
        'name' => 'required',
        'type' => 'required'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function addHabit()
    {
        $this->validate();
        $surgery = Habit::create([
            'name' => mb_strtolower($this->name),
            'slug' => Str::slug($this->name),
            'type' => mb_strtolower($this->type),
            'description' => mb_strtolower($this->description),
        ]);
        $this->reset(['name', 'description', 'type']);
        $this->render();
        $this->modal = false;
    }

    public function edit(Habit $habit)
    {
        $this->habitId = $habit->id;
        $this->name = $habit->name;
        $this->type = $habit->type;
        $this->description = $habit->description;
        $this->modalEdit = true;
    }


    public function update(Habit $habit)
    {
        $this->validate();
        if ($habit->users->count()==0) {
            $habit->name = mb_strtolower($this->name);
            $habit->slug = Str::slug($this->name);}
        $habit->type = $this->type;
        $habit->description = mb_strtolower($this->description);
        $habit->save();
        $this->reset(['name', 'description','type']);
        $this->modalEdit = false;
        $this->render();
    }

    public function delete(Habit $habit)
    {
        if ($habit->users->count()==0) {
            $habit->delete();}
    }




    public function render()
    {
        $habits = Habit::search($this->search)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->paginate($this->perPage);
        return view('livewire.doctor.habit-controller', ['habits' => $habits])->layout('layouts.doctor');
    }
}
