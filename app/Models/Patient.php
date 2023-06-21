<?php

namespace App\Models;

use App\Scopes\PatientScope;

class Patient extends User
{

    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new PatientScope);
    }

//    public function appoinments(){
//        return $this->hasMany(Appoinment::class,'patient_id');
//    }



}
