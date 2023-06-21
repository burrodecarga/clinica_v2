<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Antecedent extends Model
{
    use HasFactory;

    protected $fillable =['gender','name','slug','type','priority','description'];


    

    public static function search($search){
        return empty($search) ? static::query()
        : static::where('id',$search)
        ->orWhere('name','like','%'.$search.'%');
    }

    public function users(){
        return $this->belongsToMany(User::class)->withPivot(['id', 'year', 'name', 'observation','date'])->withTimestamps()->orderBy('name')->orderBy('year','desc');
    }
}
