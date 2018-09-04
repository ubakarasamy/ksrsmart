<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentAttendance extends Model
{
    protected $table = 'student_attendances';

    public function studentattendancerecord(){
        return $this->hasMany('App\StudentAttendanceRecord');
    }
}
