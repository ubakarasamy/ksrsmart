<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentSubject extends Model
{
    protected $table = 'student_subjects';

    public function studentschedule(){
        return $this->hasMany('App\StudentSchedule');
    }
}
