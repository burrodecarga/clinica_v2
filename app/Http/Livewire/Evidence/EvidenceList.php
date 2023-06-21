<?php

namespace App\Http\Livewire\Evidence;

use App\Models\Evidence;
use App\Models\School;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class EvidenceList extends Component
{
    public $evidencias = [], $school, $evidencia;

    protected $listeners = ['delete' => 'delete', 'renderiza' => 'render', 'renderNew'=>'render'];

    public function mount(School $school)
    {
        $this->school = $school;

    }

    public function delete(Evidence $evidence)
    {
        if (Storage::disk('public')->exists($evidence->file_path)) {
            Storage::disk('public')->delete($evidence->file_path);
            $this->evidencia = Evidence::find($evidence->id);
            $this->evidencia->delete();
            $this->school->evidences->fresh();
            $this->emitTo('evidence.evidence-list', 'renderiza');
            $this->render();

        }
    }
    public function render()
    {
        $this->evidencias = $this->school->evidences;
        return view('livewire.evidence.evidence-list');
    }
}
