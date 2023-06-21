<?php

namespace App\Http\Livewire\Interview;

use App\Models\Key;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class InterviewPatientCheck extends Component
{
    public $openModal = false;
    public $modalKey = false;
    public $keys, $keyId, $user_id, $interview_id, $search;
    public $arrayUser = [];
    public $arrayUserData = [];
    public $arrayUserDataCombine = [];
    public $arrayKey = [];
    public $name, $value_str, $value_num, $unit;

    public function mount($user_id, $interview_id)
    {
        $this->user_id = $user_id;
        $this->interview_id = $interview_id;
        $this->date = Carbon::parse(now())->format('Y-m-d');
    }

    public function modify($keyId)
    {
        $this->keyId = $keyId;
        $key = Key::find($keyId);
        $this->name = $key->name;
        $this->unit = $key->unit;
        $this->value_num = $key->min;
        $this->modalKey = true;
        $this->arrayKey = [];

    }

    public function resetKey()
    {
        $this->reset('keyId', 'name', 'unit', 'value_num');
        $this->modalKey = false;
        $this->arrayKey = $this->keys;
    }

    public function modifyKey(Key $key)
    {

        $data['name'] = $key->name;
        $data['value_str'] = $this->value_str;
        $data['value_num'] = $this->value_num;
        $data['user_id'] = $this->user_id;
        $data['interview_id'] = $this->interview_id;
        $data['key_id'] = $key->id;
        $data['unit'] = $key->unit;

        $data1['name'] = $key->name;
        $data1['value_str'] = $this->value_str;
        $data1['value_num'] = $this->value_num;
        $data1['interview_id'] = $this->interview_id;
        $data1['key_id'] = $key->id;
        $data1['unit'] = $key->unit;

        array_push($this->arrayUserDataCombine, $data1);
        array_push($this->arrayUserData, $data);
        array_push($this->arrayUser, $key->id);
        $this->modalKey = false;
    }

    public function delete(Key $key)
    {
        $this->arrayUser = array_filter(
            $this->arrayUser,
            function ($key_id) use ($key) {
                return $key->id !== $key_id;
            });

        $this->arrayUserData = array_filter($this->arrayUserData, function ($array) use ($key) {
            return $key->id !== $array['key_id'];
        });
    }

    public function save()
    {
        if (count($this->arrayUserData) > 0) {
            $user = User::find($this->user_id);
            DB::table('key_user')->where('interview_id', $this->interview_id)->delete();
            foreach ($this->arrayUserData as $d) {
                $user->keys()->attach($d['key_id'], [
                    'name' => $d['name'],
                    'value_str' => $d['value_str'],
                    'value_num' => $d['value_num'],
                    'interview_id' => $d['interview_id'],
                    'unit' => $d['unit'],
                ]);
            }

        }

        $this->emitTo('interview.interview-patient-symptoms-list', 'newList');
        $this->openModal = false;
    }

    public function render()
    {

        $search = '%' . $this->search . '%';
        $this->keys = Key::orderBy('priority', 'desc')->orderBy('name', 'asc')->
            whereNotIn('id', $this->arrayUser)->where('name', 'like', $search)
            ->take(10)->get();
        $this->arrayKey = $this->keys;
        return view('livewire.interview.interview-patient-check');
    }
}
