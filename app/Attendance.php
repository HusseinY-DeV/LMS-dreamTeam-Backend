<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    public function students()
    {
        return $this->belongsToMany('App\Student', 'attendance_student', 'attendance_id', 'student_id');
    }

    public function section()
    {
        return $this->belongsTo('App\Section');
    }
}
