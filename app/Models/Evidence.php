<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evidence extends Model
{
    use HasFactory;

    protected $fillable=[
        'school_id',
        'name',
        'file_name',
        'file_extension',
        'file_path',
        'verify',
        'verify_by',
        'verify_at',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'verify_at',
        // your other new column
    ];

   public function school(){
    return $this->belongsTo(School::class);
   }

   public static function search($search){
    return empty($search) ? static::query()
    : static::where('name',$search)
    ->orWhere('file_name','like','%'.$search.'%');
}


}
