<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subchapter extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code', 'chapter_id'];

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }

    public function themes()
    {
        return $this->hasMany(Theme::class);
    }
}
