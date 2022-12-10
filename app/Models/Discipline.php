<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discipline extends Model
{
    use HasFactory;

    protected $table = 'discipline';

    protected $fillable = [
        'name',
        'weight',
        'hours',
        'teacher_id'
    ];
}
