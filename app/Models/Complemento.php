<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complemento extends Model
{
    use HasFactory;

    protected $fillable =[
        'name',
        'dose',
        'dose_unit',
        'num_frecuency',
        'frecuency',
        'num_duration',
        'duration',
        'instruction',
        'interview_id',
        'user_id',
        'medicine_id',

    ];
    // protected $dates = [
    //     'created_at',
    //     'updated_at',
    // ];
}
