<?php

namespace App\Http\Livewire\Doctor;

use App\Models\Evidence;
use Livewire\Component;
use Livewire\WithPagination;

class VerifyController extends Component
{
    use WithPagination;
    public $search = '';
    public $perPage = 3;
    public $sortAsc = true;
    public $sortField = 'name';
    public $documentId;
    public $documentos=[];

    public $name,$modal=false, $url;

    public function marcar(Evidence $evidence){
        $evidence->verify=true;
        $evidence->verify_by=auth()->user()->name;
        $evidence->verify_at=now();
        $evidence->save();
    }

    public function desmarcar(Evidence $evidence){
        $evidence->verify=false;
        $evidence->verify_by=auth()->user()->name;
        $evidence->verify_at=now();
        $evidence->save();
    }

    public function ver(Evidence $evidence){
       $this->url = $evidence->file_path;
       $this->modal= true;
    }

    public function render()
    {
        $documents = Evidence::search($this->search)->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')->paginate($this->perPage);



        return view('livewire.doctor.verify-controller',['documents' => $documents]);
    }
}
