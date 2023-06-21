<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parameter extends Model
{
    use HasFactory;

    protected $fillable = [
        "proof",
        "proof_id",
        "name",
        "unit",
        "max_value_male",
        "min_value_male",
        "max_value_female",
        "min_value_female",
        "max_value_children",
        "min_value_children",
        'observations',

    ];

    public function users()
    {
        return $this->belongsToMany(Parameter::class)->withPivot(['proof','proof_id', 'name', 'date', 'value'])->withTimestamps()->orderBy('date', 'desc');
    }
}
