<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    use HasFactory;

    protected $fillable =['local','address','phone','mobil','email','lat','lgn','map','doctor_id'];



public function user(){
    return $this->belongsTo(User::class,'doctor_id');
}


}
