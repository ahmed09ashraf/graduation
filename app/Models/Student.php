<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['student_name', 'college_id', 'clothes', 'family_members', 'total_price'];

    public function college()
    {
        return $this->belongsTo(College::class);
    }
}
