<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'extension', 'url', 'observation', 'user_id', 'interview_id'];

    protected $dates = [
        'created_at',
        'updated_at',
        // your other new column
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function interview(){
        return $this->belongsTo(Interview::class);
    }

}
