<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uniform extends Model
{
    protected $fillable = ['item'];

    public function students()
    {
        return $this->belongsToMany(Student::class)->withTimestamps();
    }

}
