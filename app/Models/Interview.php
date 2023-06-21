<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $dates = [
        'created_at',
        'updated_at',
        'date',
        // your other new column
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getDoctorAttribute()
    {
        $doctor = User::find($this->doctor_id);
        return $doctor->name;
    }

    public function getPatientAttribute()
    {
        $doctor = User::find($this->user_id);
        return $doctor->name;
    }

    public function files()
    {
        return $this->belongsToMany(File::class)->withPivot('user_id')->withTimestamps();
    }

    public function symptoms()
    {
        return $this->belongsToMany(Symptom::class)->withPivot(['id', 'name', 'symptom_id', 'interview_id'])->withTimestamps()->orderBy('name');
    }

    public function medicines()
    {
        return $this->belongsToMany(Medicine::class)->withPivot(['name', 'dose', 'dose_unit', 'frecuency', 'num_frecuency', 'duration', 'num_duration', 'user_id', 'interview_id', 'medicine_id', 'instruction'])->withTimestamps()->orderBy('name');
    }

    public function medico(){
        $interview = Interview::find($this->interview_id);
        return $interview;
    }

}
