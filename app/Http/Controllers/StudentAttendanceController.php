<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

use App\StudentSchedule;
use App\Student;
use App\Academic;

use App\StudentAttendanceDate;
use App\StudentAttendanceHour;
use App\StudentAttendanceRecord;


class StudentAttendanceController extends Controller
{
  
    public function index()
    {
        return view('studentattendance.make');
    }
   
    public function storeDateandHourFirst(Request $request)
    {
        //CREATE DATE IN StudentAttendanceDate
        $aca = Academic::find(1);

        $IfDate1 = StudentAttendanceDate::where([
            ['date', '=', $request->date],
            ['degree', '=', $request->degree],
            ['department', '=', $request->department],
            ['year', '=', $request->year],
            ['semester', '=', $request->semester],
            ['section', '=', $request->section]
        ])->first();

        if($IfDate1 === null){
            $CreateDate = new StudentAttendanceDate;
            $CreateDate->degree = $request->degree;
            $CreateDate->department = $request->department;
            $CreateDate->year = $request->year;
            $CreateDate->semester = $request->semester;
            $CreateDate->section = $request->section;
            $CreateDate->date = $request->date;
            $CreateDate->total_hours = 1;
            $CreateDate->semester_start = $aca->semester_start;
            $CreateDate->save();
        }else{
            return response()->json($IfDate1);
        }
        // CREATE HOUR IN StudentAttendanceHour
        $IfHour = StudentAttendanceHour::where([
            ['date', '=', $request->date],
            ['degree', '=', $request->degree],
            ['department', '=', $request->department],
            ['year', '=', $request->year],
            ['semester', '=', $request->semester],
            ['section', '=', $request->section],
            ['hour', '=', $request->hour]
        ])->first();

        if($IfHour === null){
            $CreateHour = new StudentAttendanceHour;
            $CreateHour->degree = $request->degree;
            $CreateHour->department = $request->department;
            $CreateHour->year = $request->year;
            $CreateHour->semester = $request->semester;
            $CreateHour->section = $request->section;
            $CreateHour->date = $request->date;
            $CreateHour->hour = $request->hour;
            $CreateHour->schedule_id = $request->schedule_id;
            $CreateHour->is_sheduled_staff = $request->is_sheduled_staff;
            $CreateHour->alternate_staff = $request->alternate_staff;
            $CreateHour->semester_start = $aca->semester_start;
            $CreateHour->save();

            $IfDate2 = StudentAttendanceDate::where([
                ['date', '=', $request->date],
                ['degree', '=', $request->degree],
                ['department', '=', $request->department],
                ['year', '=', $request->year],
                ['semester', '=', $request->semester],
                ['section', '=', $request->section]
            ])->first();
            
            $IfDate2->total_hours = $IfDate2->total_hours + 1; // INCREATEMENT
            $IfDate2->save();
            

            return response()->json('success');
        }else{

            $ExtHour = StudentAttendanceHour::find($IfHour->id);

            return response()->json($ExtHour);
        }

    }

    public function setStudentStatusEveryHour(Request $request){

        $aca = Academic::find(1);

        $IfHour = StudentAttendanceRecord::where([
            ['date', '=', $request->date],
            ['degree', '=', $request->degree],
            ['department', '=', $request->department],
            ['year', '=', $request->year],
            ['semester', '=', $request->semester],
            ['section', '=', $request->section],
            ['hour', '=', $request->hour]
        ])->first();

        if($IfHour === null){
            $CreateHour = new StudentAttendanceRecord;
            $CreateHour->degree = $request->degree;
            $CreateHour->department = $request->department;
            $CreateHour->year = $request->year;
            $CreateHour->semester = $request->semester;
            $CreateHour->section = $request->section;

            $CreateHour->student_id = $request->student_id;
            $CreateHour->date = $request->date;
            $CreateHour->hour = $request->hour;

            if(($CreateHour->status === "absent" && $request->status !== "absent") || ($CreateHour->status === "leave" && $request->status !== "leave")){
                $CreateHour->is_present = true;
            }else{
                $CreateHour->is_present = false;
            }

            $CreateHour->status = $request->status;
            $CreateHour->semester_start = $aca->semester_start;
            $CreateHour->save();
        }
        
        
    }

    public function viewByDay(){
        return view('studentattendance.viewbyday');
    }
    public function viewByMonth(){
        return view('studentattendance.viewbymonth');
    }
    public function viewByOverall(){
        return view('studentattendance.viewbyoverall');
    }



    public function ViewJsonByDate(Request $request){

        
    }





}
