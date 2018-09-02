<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentSchedule extends Model
{
    protected $table = 'student_schedules';

    public function studentsubject(){
        return $this->belongsTo('App\StudentSubject', 'student_subject_id');
    }
}
