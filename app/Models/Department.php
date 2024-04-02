<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = ['name', 'college_id'];

    public function college(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(College::class);
    }}
