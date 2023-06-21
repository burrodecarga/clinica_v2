<?php

namespace App\Http\Livewire\Skill;

use App\Models\Skill;
use App\Models\Specialty;
use Livewire\Component;

class SkillList extends Component
{
    public $skills,$limite=10,$palabra="leer más...";
    public $title, $description, $specialty, $skill_id,$specialties=[];
    public $openModal = false;


    protected $listeners = ['delete'=>'delete','render'];

    public function delete($skillId){
        $skill = Skill::find($skillId);
        $skill->delete();
    }

    public function edit(Skill $skill)
    {

        $this->title = $skill->title;
        $this->specialty = $skill->specialty;
        $this->description = $skill->description;
        $this->skill_id = $skill->id;
        $this->openModal = true;
    }

    public function update(){
        $skill = Skill::find($this->skill_id);
        $skill->title = $this->title;
        $skill->specialty = $this->specialty;
        $skill->description = $this->description;
        $skill->save();

        $this->openModal = false;
        session()->flash('success', 'Specialty successfully updated.');
    }

    public function limitado(){
        if ($this->limite==10) {$this->limite=3000;$this->palabra="leer menos.";} else {$this->limite=10;;$this->palabra="leer más...";}
    }

    public function render()
    {
        $this->skills = auth()->user()->skills;
        $this->specialties = Specialty::orderBy('name','asc')->get();

        return view('livewire.skill.skill-list');
    }
}
