<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug', 'active', 'presentation', 'via'];

    public static function search($search){
        return empty($search) ? static::query()
        : static::where('id',$search)
        ->orWhere('name','like','%'.$search.'%');
    }

    public function interviews(){
        return $this->belongsToMany(Interview::class)->withPivot(['name','dose','dose_unit','frecuency','num_frecuency','duration','num_duration','user_id','interview_id','medicine_id','instruction'])->withTimestamps()->orderBy('name');
    }
}
