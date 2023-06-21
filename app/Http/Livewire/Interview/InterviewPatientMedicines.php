<?php

namespace App\Http\Livewire\Interview;

use App\Models\Interview;
use App\Models\Medicine;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class InterviewPatientMedicines extends Component
{

    public $search;
    public $user_id, $interview_id;
    public $date, $medicinesArrayInterview = [], $medicine, $medicineId, $medicinesArrayData = [];
    public $openModal = false;
    public $modalMedicine = false;
    public $name;
    public $dose, $dose_unit, $frecuency, $num_frecuency, $num_duration, $duration, $instruction;

    protected $rules = [
        'name' => 'required',
        'dose_unit' => 'required',
        'dose' => 'required',
        'frecuency' => 'required',
        'num_frecuency' => 'required',
        'duration' => 'required',
        'num_duration' => 'required'
    ];

    public function mount($user_id, $interview_id)
    {
        $this->user_id = $user_id;
        $this->interview_id = $interview_id;
        $this->date = Carbon::parse(now())->format('Y-m-d');
    }

    public function modify($medicineId)
    {
        $this->medicineId = $medicineId;
        $medicine = Medicine::find($medicineId);
        $this->name = $medicine->name;
        $this->modalMedicine = true;
        $this->arrayMedicine = [];
    }

    public function resetKey()
    {
        $this->reset('medicineId', 'name', 'dose_unit', 'dose', 'num_frecuency', 'num_duration', 'instruction', 'frecuency', 'duration');
        $this->modalMedicine = false;
        $this->arrayMedicine = $this->medicines;
    }

    public function modifyKey(Medicine $medicine)
    {

        $this->validate();
        $str = 'dar ' . $this->dose . ' ' . $this->dose_unit . ', cada ' . $this->num_frecuency . '  ' . $this->frecuency . ' por ' . $this->num_duration . ' ' . $this->duration;

        $data['name'] = $medicine->name;
        $data['dose'] = $this->dose;
        $data['dose_unit'] = $this->dose_unit;
        $data['frecuency'] = $this->frecuency;
        $data['num_frecuency'] = $this->num_frecuency;
        $data['duration'] = $this->duration;
        $data['num_duration'] = $this->num_duration;
        $data['instruction'] = ($this->instruction? $str.', '.$this->instruction:$str);

        $data['user_id'] = $this->user_id;
        $data['interview_id'] = $this->interview_id;
        $data['medicine_id'] = $medicine->id;

        $data1['name'] = $medicine->name;

        $data1['dose'] = $this->dose;
        $data1['dose_unit'] = $this->dose_unit;
        $data1['frecuency'] = $this->frecuency;
        $data1['num_frecuency'] = $this->num_frecuency;
        $data1['duration'] = $this->duration;
        $data1['num_duration'] = $this->num_duration;

        $data1['interview_id'] = $this->interview_id;
        $data1['medicine_id'] = $medicine->id;

        array_push($this->medicinesArrayData, $data);
        array_push($this->medicinesArrayInterview, $medicine->id);
        $this->reset('medicineId', 'name', 'dose_unit', 'dose', 'num_frecuency', 'num_duration', 'instruction', 'frecuency', 'duration');
        $this->modalMedicine = false;
    }

    public function delete(Medicine $medicine)
    {
        $this->medicinesArrayInterview = array_filter(
            $this->medicinesArrayInterview,
            function ($medicine_id) use ($medicine) {
                return $medicine->id !== $medicine_id;
            });

        $this->medicinesArrayData = array_filter($this->medicinesArrayData, function ($array) use ($medicine) {
            return $medicine->id !== $array['medicine_id'];
        });
    }

    public function save()
    {
        if (count($this->medicinesArrayData) > 0) {
            $interview = Interview::find($this->interview_id);
            DB::table('interview_medicine')->where('interview_id', $this->interview_id)->delete();
            foreach ($this->medicinesArrayData as $d) {
                $interview->medicines()->attach($d['medicine_id'], [
                    'name' => $d['name'],
                    'dose' => $d['dose'],
                    'dose_unit' => $d['dose_unit'],
                    'frecuency' => $d['frecuency'],
                    'num_frecuency' => $d['num_frecuency'],
                    'duration' => $d['duration'],
                    'instruction' => $d['instruction'],
                    'num_duration' => $d['num_duration'],
                    'interview_id' => $d['interview_id'],
                    'user_id' => $d['user_id'],
                ]);
            }

        }

        $this->emitTo('interview.interview-patient-symptoms-list', 'newList');
        $this->openModal = false;
    }

    public function render()
    {
        $search = '%' . $this->search . '%';
        $this->medicines = Medicine::orderBy('name', 'desc')->
            whereNotIn('id', $this->medicinesArrayInterview)->where('name', 'like', $search)
            ->take(10)->get();
        $this->medicinesArray = $this->medicines;

        $doses_unit = DB::table('dose')->orderBy('unidad')->get();

        return view('livewire.interview.interview-patient-medicines', ['doses_unit' => $doses_unit]);
    }
}
