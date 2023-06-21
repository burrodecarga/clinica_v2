<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surgery extends Model
{
    use HasFactory;
    protected $fillable =['name','slug','description'];

    public static function search($search){
        return empty($search) ? static::query()
        : static::where('id',$search)
        ->orWhere('name','like','%'.$search.'%');
    }

    public function users(){
        return $this->belongsToMany(User::class)->withPivot(['name', 'year', 'type', 'observation','id'])->withTimestamps()->orderBy('name');

    }
}
