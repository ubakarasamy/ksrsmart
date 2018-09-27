<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Student;
use App\Academic;

class AcademicController extends Controller
{
    

        /*
     * /increase Semester and Year of student
     */
    public function closeSemester(Request $request){
        // $semm = Academics::findOrFail(1);
        $students = Student::where('status', 'current')->get();
        
            $aca = Academic::findOrFail(1);
            $aca->semester_start = $request->semStart;
            $aca->save();
        foreach($students as $student){
        
        if($student->degree === 'be'){
        if($student->semester < 8 && $student->semester === 2 || $student->semester === 4 || $student->semester === 6){
            //increase Semester and Year
            $student->semester = $student->semester + 1;
            $student->year = $student->year + 1;
            
        }elseif($student->semester < 8){
            //increase semester
            $student->semester = $student->semester + 1;
        }elseif($student->semester === 8){
            $student->status = 'passed-out';
        }
            $student->save();
     
        }else if($student->degree === 'me'){
            if($student->semester < 4 && $student->semester === 2){
                //increase Semester and Year
                $student->semester = $student->semester + 1;
                $student->year = $student->year + 1;
                
            }elseif($student->semester < 4){
                //increase semester
                $student->semester = $student->semester + 1;
            }elseif($student->semester === 4){
                $student->status = 'passed-out';
            }
                $student->save();
            }
        }
        return response()->json('closed');
    
    }
    /*
     * fetch Academic
     */
    public function fetchSemester(){
        return Academic::find(1);
    }
    /*
     * post Academic
     */
    public function postAcademic(Request $request){
        $year = $request->academicYear;
        $cl = $request->academicCL;
        $od = $request->academicOD;
        $permission = $request->academicPermission;
        $late = $request->academicLate;
        $data = Academic::findOrFail(1);
        $data->year_start = $year;
        $data->staff_cl = $cl;
        $data->staff_od = $od;
        $data->staff_permission = $permission;
        $data->staff_lateregister = $late;
        $data->save();
        return response()->json('updated');
    }

}
