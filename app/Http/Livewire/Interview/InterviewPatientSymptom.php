<?php

namespace App\Http\Livewire\Interview;

use App\Models\Interview;
use App\Models\Symptom;
use App\Models\User;
use Illuminate\Support\Str;
use Livewire\Component;

class InterviewPatientSymptom extends Component
{
    public $openModal = false;
    public $arraySymptom=[];
    public $arrayUser=[];
    public $ymptoms=[];
    public $user_symptoms_id;
    public $search = '';
    public $newName, $slug;
    public $user_symptoms;
    public $user,$interview,$interview_id;

    public function mount($user_id,$interview_id)
    {
        $this->user_symptoms_id = $user_id;
        $this->user = User::find($user_id);
        $this->interview = Interview::find($interview_id);
        $this->interview_id =$interview_id;
    }

    public function addNew()
    {
        $name = $this->search;
        $name = mb_strtolower($name);
        $this->slug = Str::slug($name);
        $exist = Symptom::where('slug', $this->slug)->exists();
        if (!$exist) {
            Symptom::create([
                'name' => $name,
                'slug' => $this->slug,
            ]);
        } else {
            return session()->flash('fail', 'sintoma repetido');
        }
        $this->search = '';
        $this->render();
    }

    public function modify(Symptom $symptom)
    {
        //dd($symptom);
        array_push($this->arrayUser, $symptom->id);

    }

    public function del(Symptom $symptom)
    {

         $this->arrayUser = array_filter(
             $this->arrayUser,
             function ($key) use ($symptom) {
                 return $symptom->id !== $key;
             });
    }

    public function save()
    {
        $this->user->symptoms()->syncWithPivotValues($this->arrayUser, ['interview_id' => $this->interview_id]);
        $this->interview->symptoms()->syncWithPivotValues($this->arrayUser, ['user_id' => $this->user->id]);
        $this->emitTo('interview.interview-patient-symptoms-list', 'newList');
        $this->openModal = false;
    }

    public function render()
    {

        $this->user_symptoms = Symptom::orderBy('name', 'asc')->whereIn('id', $this->arrayUser)->pluck('name', 'id');
        $search = '%' . $this->search . '%';
        $this->symptoms = Symptom::orderBy('name', 'asc')->whereNotIn('id', $this->arrayUser)->where('name', 'like', $search)
            ->take(10)->get();

        $this->arraySymptom = $this->symptoms;

        return view('livewire.interview.interview-patient-symptom');
    }
}
