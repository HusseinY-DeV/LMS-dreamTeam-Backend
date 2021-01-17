<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    public function section()
    {
        return $this->belongsTo('App\Section');
    }

    public function student()
    {
        return $this->belongsToMany('App\Student', 'student_attendance', 'attendance_id', 'student_id')->withPivot('status', 'id');
    }
}