<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Habit extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'name', 'slug', 'description'];

    public static function search($search)
    {
        return empty($search) ? static::query()
        : static::where('id', $search)
            ->orWhere('name', 'like', '%' . $search . '%');
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot(['id','type', 'name', 'slug', 'quantity', 'frecuency', 'severity', 'time','observation'])->withTimestamps()->orderBy('name')->orderBy('type');
    }
}
