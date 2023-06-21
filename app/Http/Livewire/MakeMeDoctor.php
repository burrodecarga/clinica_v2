<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class MakeMeDoctor extends Component
{
    public $open ='hidden';

    public function show(){
        $this->open = 'visible';
    }


    public function doctor($n){

        if($n=='1'){
            $this->open = 'hidden';
            $user = auth()->user();
            $user->isDoctor= false;
            $user->roles()->sync('3');
            $user->save();
            auth('web')->logout();
            return redirect('/login');
        }else{
            $this->open = 'hidden';
        }
    }


    public function render()
    {
        return view('livewire.make-me-doctor');
    }
}
