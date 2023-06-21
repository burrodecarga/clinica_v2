<?php

namespace App\Http\Livewire\Specialty;

use App\Models\Specialty;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SpecialtyList extends Component
{
    public $specialties=[];

    protected $listeners=['reload'=>'reload'];

    public function reload(){
        $this->render();
    }

    public function delete(Specialty $specialty){
        $user = auth()->user();
        $toDelete = DB::table('specialty_user')->where('specialty_id', $specialty->id)
        ->where('user_id', $user->id)->delete();
    }


    public function render()
    {
        $this->specialties = auth()->user()->specialties;
        return view('livewire.specialty.specialty-list');
    }
}
