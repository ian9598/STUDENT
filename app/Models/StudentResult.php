<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentResult extends Model
{
    use HasFactory;
    public $primaryKey = 'result_id';
    protected $table = 'student_result';
    public $timestamps = true;

    protected $fillable = [
        'course', 'mark'
    ];
}
