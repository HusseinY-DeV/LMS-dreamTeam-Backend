<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    public function students()
    {
        return $this->hasMany('App\Student', 'section_id', 'id');
    }

    function class ()
    {
        return $this->belongsTo('App\Classe');
    }

<<<<<<< HEAD
    public function attendances()
    {
        return $this->hasMany('App\Attendance');
    }
}
=======
    public function attendance()
    {
        return $this->hasMany('App\Attendance');
    }
}
>>>>>>> origin/huzz
