<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentDiscipline extends Model
{
    use HasFactory;

    protected $primaryKey = ['student_id', 'discipline_id'];

    public $incrementing = false;

    protected $table = 'student_discipline';

    protected $fillable = [
        'student_id',
        'discipline_id'
    ];
}
