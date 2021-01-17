<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public function section()
    {
        return $this->belongsTo('App\Section');
    }

    public function attendance()
    {
        return $this->belongsToMany('App\Attendance', 'student_attendance', 'student_id', 'attendance_id')->withPivot('status', 'id');
    }
}