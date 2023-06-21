<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code', 'subchapter_id'];

    public function subchapter()
    {
        return $this->belongsTo(Subchapters::class);
    }
}
