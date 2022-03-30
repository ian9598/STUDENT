<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentInfo extends Model
{
    use HasFactory;
    public $primaryKey = 'student_id';
    protected $table = 'student_info';
    public $incrementing = false; //avoid 0 value display in table
    public $timestamps = true;

    protected $fillable = [
        'student_name', 'gender', 'ic'
    ];
}
