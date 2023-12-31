<?php

namespace App\Http\Livewire\Specialty;

use App\Models\Specialty;
use Livewire\Component;

class SpecialtyCreate extends Component
{
    public $openModal=false;
    public $specialties;
    public $user_specialties_id;
    public $search='rrrr';
    public $user_specialties;


    public function modify($s){

     $old_ids =  $this->user_specialties_id = auth()->user()->specialties()
     ->pluck('specialty_id')->toArray();

     array_push($old_ids,$s);

     auth()->user()->specialties()->sync($old_ids);
     $this->user_specialties_id = auth()->user()->specialties()
     ->pluck('specialty_id')->toArray();
     $this->emitTo('specialty.specialty-list','reload');

   }

    public function del($s){
        $old_ids = auth()->user()->specialties()
        ->pluck('specialty_id');

        $new = $old_ids->filter(function($i) use($s) {
            return $i !== $s;
        });

       auth()->user()->specialties()->sync($new);

        $this->user_specialties_id = auth()->user()->specialties()
        ->pluck('specialty_id')->toArray();

        $this->emitTo('specialty.specialty-list','reload');

    }

    public function updatingSearch()
    {

    }




    public function render()
    {
        $search = '%'.$this->search.'%';

        $this->user_specialties_id = auth()->user()->specialties()
        ->pluck('specialty_id')->toArray();

        $this->user_specialties = auth()->user()->specialties;


         $this->specialties = Specialty::whereNotIn('id',$this->user_specialties_id)->where('name','like',$search)
         ->take(5)->get();
        return view('livewire.specialty.specialty-create');
    }
}
