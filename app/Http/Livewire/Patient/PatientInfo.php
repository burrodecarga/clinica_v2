<?php

namespace App\Http\Livewire\Patient;

use App\Models\Appoinment;
use App\Models\File;
use App\Models\Interview;
use App\Models\Medicine;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class PatientInfo extends Component
{

    use WithPagination;

    protected $listeners =['actualizar'=>'actualizar'];

    public function actualizar(){
        $value = 'Su Cita ha sido creada Exitósamente, revise Historial';
        $this->dispatchBrowserEvent('name-updated', ['newName' => $value]);
    $this->render();

   }

    public function render()
    {
        $desde = today();
        $hasta = now()->addDays(15);
        $anterior = now()->subDays(90);
        $patient_id = auth()->user()->id;
        $appoinments =Appoinment::where('patient_id', $patient_id)->whereBetween('date',[$desde,$hasta])->orderBy('date', 'desc')->orderBy('hour', 'asc')->limit(5)->get();
        $interviews =Interview::where('user_id',$patient_id)->whereBetween('date',[$anterior,$hasta])->orderBy('date', 'desc')->limit(3)->get();


        $files = File::where('user_id','=',auth()->user()->id)->paginate(2);

        $this->resetPage();
        $medicines = DB::table('interview_medicine')->where('user_id',$patient_id)->latest()->paginate(3);
        //dd($medicines,auth()->user()->id);

        return view('livewire.patient.patient-info',compact('appoinments','interviews','files','medicines'));
    }
}
