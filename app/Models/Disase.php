<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disase extends Model
{

    protected $fillable =['name','slug','symptoms'];
    use HasFactory;


    public static function search($search){
        return empty($search) ? static::query()
        : static::where('id',$search)
        ->orWhere('name','like','%'.$search.'%');
    }

public function users(){
return $this->belongsToMany(User::class)->withPivot(['id', 'year', 'condition', 'inherited', 'deceased', 'doctor', 'name', 'observation'])->withTimestamps()->orderBy('name');



    }

}
