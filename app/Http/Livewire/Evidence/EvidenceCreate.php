<?php

namespace App\Http\Livewire\Evidence;

use App\Models\Evidence;
use Livewire\Component;
use Livewire\WithFileUploads;

class EvidenceCreate extends Component
{
    use WithFileUploads;

    public $file, $schoolId;

    protected $rules = ['file' => ['required', 'mimes:pdf,png,jpg,jpeg,gif']];

    public function mount($schoolId)
    {
        $this->schoolId = $schoolId;
    }

    public function save()
    {
        $this->validate();
        $file_save = new Evidence();
$file_save->name = auth()->user()->name;

        $file_save->file_name = $this->file->getClientOriginalName();
        $file_save->file_extension = $this->file->extension();
        $file_save->file_path = $this->file->store('evidences', 'public');
        $file_save->school_id = $this->schoolId;
        $file_save->save();
        $this->reset('file');
$this->emitTo('evidence.evidence-list', 'renderNew');

    }

    public function render()
    {
        return view('livewire.evidence.evidence-create');
    }
}
