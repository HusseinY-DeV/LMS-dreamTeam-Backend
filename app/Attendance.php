<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
<<<<<<< HEAD
    public function students()
    {
        return $this->belongsToMany('App\Student', 'attendance_student', 'attendance_id', 'student_id');
    }

    public function section()
    {
        return $this->belongsTo('App\Section');
    }
}
=======
    public $timestamps = false;
    public function section()
    {
        return $this->belongsTo('App\Section');
    }

    public function student()
    {
        return $this->belongsToMany('App\Student', 'student_attendance', 'attendance_id', 'student_id')->withPivot('status');
    }
}
>>>>>>> origin/huzz
