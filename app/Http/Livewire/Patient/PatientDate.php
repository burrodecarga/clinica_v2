<?php

namespace App\Http\Livewire\Patient;

use App\Models\Appoinment;
use App\Models\Hour;
use App\Models\Workday;
use Carbon\Carbon;
use Livewire\Component;

class PatientDate extends Component
{
    public $openModal = false;
    public $date, $day;
    public $appoinments, $doctor_id, $specialty_id, $intervals = [];
    public $workday, $interval;
    public $morning = [], $afternoon = [], $evening = [];

    protected $listeners = ['selectDate' => 'selectDate', 'addAppoinment' => 'addAppoinment'];

    public function selectDate($doctorID, $specialtyID)
    {
        $this->reset('date');
        $this->morning = [];
        $this->afternoon = [];
        $this->evening = [];
        $this->doctor_id = $doctorID;
        $this->specialty_id = $specialtyID;
        $this->openModal = true;
    }

    public function updatedDate($value)
    {

        $this->morning = [];
        $this->afternoon = [];
        $this->evening = [];

        $newDate = new Carbon($value);
        $hoy = Carbon::now();
        if($hoy->gt($newDate)){
            session()->flash('message', 'La fecha seleccionada no es válida.');
            return redirect()->back();
        }
        $this->day = $newDate->dayOfWeek;
        $work = Workday::where('doctor_id', $this->doctor_id)
            ->where('day', $this->day)->first();

        if(
        ($work->morning_start ==$work->morning_end) and
        ($work->afternoon_start ==$work->afternoon_end) and
        ($work->evening_start == $work->evening_end)
        ){
            session()->flash('message', 'No hay horario para el día selecionado.');
            return redirect()->back();
        };

        $int1 = $this->getIntervalo($work->morning_start, $work->morning_end);
        $int2 = $this->getIntervalo($work->afternoon_start, $work->afternoon_end);
        $int3 = $this->getIntervalo($work->evening_start, $work->evening_end);

        $this->morning = $int1;
        $this->afternoon = $int2;
        $this->evening = $int3;
    }

    public function getIntervalo($start, $end)
    {
        $appoinments = Appoinment::where('date', $this->date)
            ->where('doctor_id', $this->doctor_id)
            ->pluck('hour_id')->toArray();

        $array = [];
        if ($start < $end) {
            for ($i = $start; $i <= $end; $i++) {
                $var = Hour::find($i);
                if (!in_array($var->id, $appoinments)) {
                    array_push($array, $var->interval);
                }

            }
        } else {
            $array = [];
        }
        return $array;
    }

    public function selecccionar($m)
    {
        $hour = Hour::where('interval', $m)->first();
        $work = Workday::find($hour->id);

        switch ($hour->turn) {
            case 'dawn':
                $office = $work->evening_office;
                $price = $work->evening_price;
                break;
            case 'morning':
                $office = $work->morning_office;
                $price = $work->morning_price;
                break;
            case 'afternoon':
                $office = $work->afternoon_office;
                $price = $work->afternoon_price;
                break;
            case 'evening':
                $office = $work->evening_office;
                $price = $work->evening_price;
                break;
        }

        $this->dispatchBrowserEvent('store-data', [
            'interval' => $hour->interval,
            'doctor_id' => $this->doctor_id,
            'specialty_id' => $this->specialty_id,
            'day' => $this->day,
            'date' => $this->date,
            'price' => $price,
            'office' => $office,

        ]);

        if (auth()->user()) {
            $this->dispatchBrowserEvent('delete-data');
            //crea cita
            Appoinment::create([
                'patient_id' => auth()->user()->id,
                'doctor_id' => $this->doctor_id,
                'specialty_id' => $this->specialty_id,
                'date' => $this->date,
                'hour' => $hour->time_hour,
                'hour_id' => $hour->id,
                'office' => $office,
                //  'price' => $price,
            ]);
            $this->emitTo('patient.patient-info','actualizar');
            $this->openModal = false;

        } else {

            //guardar la cita
            $this->openModal = false;
            //logear al usuario
            return redirect()->route('login');
            //crear cita
        }
    }

    public function addAppoinment($interval, $doctor_id, $specialty_id, $day, $date, $price, $office)
    {

        $hour = Hour::where('interval', $interval)->first();
        $work = Workday::find($hour->id);

        if(auth()->user())
        {
           Appoinment::create([
            'patient_id' => auth()->user()->id,
            'doctor_id' => $doctor_id,
            'specialty_id' => $specialty_id,
            'date' => $date,
            'hour' => $hour->time_hour,
            'hour_id' => $hour->id,
            'office' => $office,
            'price' => $price,
        ]);


        $this->emitTo('patient.patient-info','actualizar');

        }
        $this->dispatchBrowserEvent('delete-data');

    }

    public function render()
    {
        return view('livewire.patient.patient-date');
    }
}
