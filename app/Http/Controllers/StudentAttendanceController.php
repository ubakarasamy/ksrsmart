<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

use App\StudentAttendance;
use App\StudentSchedule;
use App\StudentAttendanceRecord;
use App\Student;
use App\StudentAttendanceDate;
use App\Academic;
use App\StudentDateAttendance;


class StudentAttendanceController extends Controller
{
  
    public function index()
    {
        return view('studentattendance.make');
    }
   
    public function store(Request $request)
    {
        $ifExit = StudentAttendance::where([
            ['schedule_id', '=', $request->schedule_id],
            ['date', '=', $request->date],
            ])->first();   

            $aca = Academic::findOrFail(1);
       

        if($ifExit !== null){
            return response()->json($ifExit);
        }else{
            $attendance = new StudentAttendance;
            $attendance->schedule_id = $request->schedule_id;
            $attendance->date = $request->date;
            $attendance->alternate_staff = $request->alternative_staff;
            $attendance->edit_permission = true;
            $attendance->save();
            return response()->json($attendance);
        }
        //return response()->json($attendance);


        $Datt1 = StudentAttendance::where([
            ['date', '=', $request->date],
            ])->first();   


    if($Datt1 === null){
        $Datt2 = new StudentAttendanceDate;
        $Datt2->date = $request->date;
        $Datt2->total_hours = 0;
        $Datt2->semester_start = $aca->semester_start;
        $Datt2->save();
    }

       
    }

    public function setStatus(Request $request){

        $ifExit = StudentAttendanceRecord::where([
            ['student_id', '=', $request->student_id],
            ['schedule_id', '=', $request->schedule_id],
            ['date', '=', $request->date],
            ['student_attendance_id', '=', $request->student_attendance_id]
            ])->first();    

            $DateAt = StudentAttendanceRecord::where([
                ['student_id', '=', $request->student_id],
                ['schedule_id', '=', $request->schedule_id],
                ['date', '=', $request->date],
                ['student_attendance_id', '=', $request->student_attendance_id]
                ])->first();  

                $aca = Academic::findOrFail(1);

        $DateExit = StudentDateAttendance::where([['date', '=', $request->date]])->first();

        if($DateExit === null){
            $DateNw = new StudentDateAttendance;
            $DateNw->date = $request->date;
            $DateNw->student_id = $request->student_id;
            $DateNw->total_hours = 1;
            $DateNw->semester_start = $aca->semester_start;
            $DateNw->save();
        }else{
            $dateATT = StudentDateAttendance::find($DateExit->id);

            if(($ifExit->status === "absent" && $request->status !== "absent") || ($ifExit->status === "leave" && $request->status !== "leave")){
               
                $dateATT->total_hours = $DateNw->total_hours++;
           
        }else{
            $dateATT->total_hours = $DateNw->total_hours--;
        }
            
            $dateATT->save();
        }


        if($ifExit !== null){

            $ifExit->student_id = $request->student_id;
            $ifExit->schedule_id = $request->schedule_id;
            $ifExit->date = $request->date;
            $ifExit->student_attendance_id = $request->student_attendance_id;

            if(($ifExit->status === "absent" && $request->status !== "absent") || ($ifExit->status === "leave" && $request->status !== "leave")){
               
                    $ifExit->present = true;
               
            }else{
                $ifExit->present = false;
            }
            
            $ifExit->status = $request->status;
            $ifExit->save();
            return response()->json('exists');
        }else{
            $ifExit = new StudentAttendanceRecord;
            $ifExit->student_id = $request->student_id;
            $ifExit->schedule_id = $request->schedule_id;
            $ifExit->date = $request->date;
            $ifExit->student_attendance_id = $request->student_attendance_id;
            $ifExit->status = $request->status;

            if($request->status !== "absent" || $request->status === "leave"){
                $ifExit->present = true;
            }else{
                $ifExit->present = false;
            }

            $ifExit->save();
            return response()->json($request);
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

        $fromdate = $request->fromdate;
        $todate = $request->todate;
        $degree = $request->degree;
        $department = $request->department;
        $year = $request->year;
        $semester = $request->semester;
        $section = $request->section;  
        
        // IMPORTANT

        $AllStudents = Student::where([
                ['degree', '=', $degree],
                    ['department', '=', $department],
                    ['year', '=', $year],
                    ['semester', '=', $semester],
                    ['section', '=', $section]
            ])->get();
        $attendanceDates = StudentAttendanceDate::where([
            ['date', '>=', $fromdate],
            ['date', '<=', $todate],
        ])->get();

        $attendanceHours = StudentAttendance::where([
            ['date', '>=', $fromdate],
            ['date', '<=', $todate],
        ])->get(); //all working hours

        $Schedules = StudentSchedule::where([
            ['degree', '=', $degree],
            ['department', '=', $department],
            ['year', '=', $year],
            ['semester', '=', $semester],
            ['section', '=', $section]
        ])->first();

        $Records = StudentAttendanceRecord::where([
                    ['date', '>=', $fromdate],
                    ['date', '<=', $todate]
                ])->get();

       

        $Res = ['Atdates' => $attendanceDates, 'Atdatas' => $Records];

        

return response()->json($Res);
       

        //return response()->json(['working_hours'=>$AWHs,'atdatas'=>$AStHrs]);
    }





}
