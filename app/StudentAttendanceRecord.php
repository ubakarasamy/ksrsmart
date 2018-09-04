<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentAttendanceRecord extends Model
{
    protected $table = 'student_attendance_records';

    public function studentattendance(){
        return $this->belongsTo('App\StudentAttendance', 'student_attendance_id');
    }
}
