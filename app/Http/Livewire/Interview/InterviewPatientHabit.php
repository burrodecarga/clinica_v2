<?php

namespace App\Http\Livewire\Interview;

use App\Models\Habit;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Livewire\Component;

class InterviewPatientHabit extends Component
{

    public $patient, $user_id;
    public $modal = false;
    public $modalEdit = false;
    public $habitEditId, $habit_id;
    public $type, $name, $quantity, $frecuency, $severity, $time, $observation;

    public function mount($user_id)
    {
        $this->user_id = $user_id;
        $this->patient = User::find($user_id);
        // $this->date = Carbon::parse(now())->format('Y-m-d');
    }

    protected $rules = [
        'quantity' => 'required|numeric',
        'frecuency' => 'required',
        'severity' => 'required',
        'habit_id' => 'required'];

    public function addHabit()
    {
        $data = $this->validate();
        $habito = Habit::find($this->habit_id);
        $this->patient->habits()->attach($data['habit_id'],
            ['quantity' => $data['quantity'],
                'severity' => $data['severity'],
                'frecuency' => $data['frecuency'],
                'time' => $this->time,
                'type' => $habito->type,
                'observation' => mb_strtolower($this->observation),
                'name' => $habito->name,
                'slug' => Str::slug($habito->name),
            ]);
        $this->modal = false;
        $this->resetValidation();
        $this->reset('name', 'type', 'observation', 'habit_id', 'quantity', 'severity', 'frecuency');
        $this->render();
    }

    public function edit($pivot)
    {
        $habitEdit = collect(\DB::select("SELECT * FROM habit_user WHERE id=$pivot"))->first();
        $this->habitEditId = $pivot;
        $this->habit_id = $habitEdit->habit_id;
        $this->name = $habitEdit->name;
        $this->type = $habitEdit->type;
        $this->quantity = $habitEdit->quantity;
        $this->severity = $habitEdit->severity;
        $this->frecuency = $habitEdit->frecuency;
        $this->observation = $habitEdit->observation;
        $this->modalEdit = true;
    }

    public function update()
    {

        $this->validate();
        $habito = Habit::find($this->habit_id);
        DB::table('habit_user')->where('id', $this->habitEditId)->update(array(
            'type' => $this->type,
            'quantity' => $this->quantity,
            'severity' => $this->severity,
            'frecuency' => $this->frecuency,
            'name' => $habito->name,
            'time' => $this->time,
            'habit_id' => $this->habit_id,
            'observation' => $this->observation,
        ));

        $this->modalEdit = false;
    }

    public function delete()
    {
        DB::table('habit_user')->where('id', $this->habitEditId)->delete();
        $this->modalEdit = false;
    }

    public function render()
    {
        $user = User::find($this->user_id);
        $this->patient = $user;
        $patient_habits = $user->habits;
        $habit_list = Habit::orderBy('name')->get();
        return view('livewire.interview.interview-patient-habit', [
            'user' => $user,
            'patient_habits' => $patient_habits,
            'habit_list' => $habit_list,
        ]);
    }
}
