<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['student_name', 'college_id', 'department_id', 'clothes', 'family_members', 'student_price', 'member_price', 'total_price'];

    public function college()
    {
        return $this->belongsTo(College::class);
    }

    // Assuming we're adding a direct relationship for demonstration
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function uniforms()
    {
        return $this->belongsToMany(Uniform::class)->withTimestamps();
    }

}
