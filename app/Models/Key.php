<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Key extends Model
{
    use HasFactory;

    protected $fillable =['specialty','group','name','unit','max','min','priority'];

    protected $dates = [
        'created_at',
        'updated_at',
        // your other new column
    ];


    public static function search($search){
        return empty($search) ? static::query()
        : static::where('id',$search)
        ->orWhere('name','like','%'.$search.'%');
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot(['id', 'name','value_str','value_num','interview_id','key_id','user_id'])->withTimestamps()->orderBy('name');
    }


}
