<?php

namespace App\Http\Livewire\Interview;

use App\Models\File;
use App\Models\User;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class InterviewPatientFile extends Component
{

    use WithFileUploads;

    public $openModal, $file, $observation, $name, $user_id, $interview_id;

    protected $rules = [
        'file' => ['required', 'mimes:png,jpg,jpeg,pdf'],
        'name' => ['required'],
        'observation' => ['required'],
    ];

    public function add()
    {
        $this->validate();
        if (strlen($this->observation) < 150) {
            $tamaño = Str::limit($this->observation, 149) . '.';

            $this->observation = $tamaño;
        }
        //$user = User::find($this->user_id);
        $file = new File();
        $file->user_id = $this->user_id;
        $file->interview_id = $this->interview_id;
        $file->name = $this->name;
        $file->extension = $this->file->extension();
        $file->url = 'storage/' . $this->file->store('archivos', 'public');
        $file->observation = $this->observation;
        $file->save();
        $this->openModal = false;
        $this->reset('file', 'observation', 'name');
        //$user->files()->attach($file->id, ['user_id' => $user->id]);
    }

    public function mount($user_id)
    {
        $this->user_id = $user_id;
    }

    public function del(File $file)
    {

        $url = $file->url;
        if (file_exists($url)) {unlink($url);};
        $file->delete();

    }

    public function render()
    {
        $user = User::find($this->user_id);

        $patient_files = $user->files;
        return view('livewire.interview.interview-patient-file', compact('patient_files'));
    }
}
