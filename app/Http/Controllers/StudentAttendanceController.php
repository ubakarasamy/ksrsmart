<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

use App\StudentAttendance;
use App\StudentSchedule;
use App\StudentAttendanceRecord;


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
       
    }

    public function setStatus(Request $request){

        $ifExit = StudentAttendanceRecord::where([
            ['student_id', '=', $request->student_id],
            ['schedule_id', '=', $request->schedule_id],
            ['date', '=', $request->date],
            ['student_attendance_id', '=', $request->student_attendance_id]
            ])->first();    
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
        $attendanceHours = StudentAttendance::where([
            ['date', '>=', $fromdate],
            ['date', '<=', $todate],
        ])->get();

        $attendanceHours; //all working Hours

        $AWHs = [];

        $AStHrs = [];

        foreach ($attendanceHours as $attendanceHour) {
            $hour = StudentSchedule::where([
                ['id', '=', $attendanceHour->schedule_id],
                ['degree', '=', $degree],
                ['department', '=', $department],
                ['year', '=', $year],
                ['semester', '=', $semester],
                ['section', '=', $section]
            ])->first();

            array_push($AWHs, $hour); //all working hours for class

            $attt = StudentAttendanceRecord::where([
                ['schedule_id', '=', $hour->id],
                ['date', '>=', $fromdate],
                ['date', '<=', $todate]
            ])->get();
            
            
            array_push($AStHrs, $attt); //all present datas for class

        }

        


       



       

        return response()->json(['working_hours'=>$AWHs,'atdatas'=>$AStHrs]);
    }





}
