<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Appoinment extends Model
{
    use HasFactory;
    use Notifiable;

    const PENDING   = 'PENDIENTE';
    const CONFIRMED   = 'CONFIRMADO';
    const ACCOMPLISHED   = 'REALIZADA';
    const UNREALIZED   = 'NO REALIZADA';
    const CANCELED   = 'CANCELADA';

    protected $guarded=[];

    protected $dates = [
        'created_at',
        'updated_at',
        'date',
        'hour'
        // your other new column
    ];

public function getPatientAttribute(){
    $patient = User::find($this->patient_id);
    return $patient;
}

public function getDoctorAttribute(){
    $doctor = User::find($this->doctor_id);
    return $doctor;
}

public function getSpecialtyAttribute(){
    $specialty = Specialty::find($this->specialty_id);
    return $specialty;
}

public function getOficinaAttribute(){
    $oficina = Office::find($this->office);
    return $oficina;

}





public function user(){
    return $this->belongsTo(User::class);
}


}
