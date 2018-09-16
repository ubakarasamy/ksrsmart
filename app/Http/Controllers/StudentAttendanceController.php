<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

use App\StudentSchedule;
use App\StudentSubject;

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
    public function EditAt()
    {
        return view('studentattendance.edit');
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
    public function viewBySubject(){
        return view('studentattendance.viewbysubject');
    }

// INSERT DATE HOUR   
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
            //do nothing
            //return response()->json($IfDate1);
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

            if( $CreateHour->save()){
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
            }
            
            // return response()->json('success');
            $CurrentRecords = StudentAttendanceRecord::where([
                ['date', '=', $request->date],
                ['degree', '=', $request->degree],
                ['department', '=', $request->department],
                ['year', '=', $request->year],
                ['semester', '=', $request->semester],
                ['section', '=', $request->section],
                ['hour', '=', $request->hour]
            ])->get();

            return response()->json($CurrentRecords);

        }else{

            $ExtHour = StudentAttendanceHour::find($IfHour->id);

            $CurrentRecords = StudentAttendanceRecord::where([
                ['date', '=', $request->date],
                ['degree', '=', $request->degree],
                ['department', '=', $request->department],
                ['year', '=', $request->year],
                ['semester', '=', $request->semester],
                ['section', '=', $request->section],
                ['hour', '=', $request->hour]
            ])->get();

            return response()->json($CurrentRecords);
        }
    }
// INSERT STUDENT EACH HOUR STATUS
    public function setStudentStatusEveryHour(Request $request){

        $aca = Academic::find(1);

        $IfHour = StudentAttendanceRecord::where([
            ['student_id', '=', $request->student_id],
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

            $CreateHour->schedule_id = $request->schedule_id;
            $CreateHour->student_id = $request->student_id;
            $CreateHour->date = $request->date;
            $CreateHour->hour = $request->hour;

            if($request->status === "absent" || $request->status === "leave"){
                $CreateHour->is_present = false;
            }else{
                $CreateHour->is_present = true;
            }

            $CreateHour->status = $request->status;
            $CreateHour->semester_start = $aca->semester_start;
            $CreateHour->save();


            $CurrentRecords = StudentAttendanceRecord::where([
                ['date', '=', $request->date],
                ['degree', '=', $request->degree],
                ['department', '=', $request->department],
                ['year', '=', $request->year],
                ['semester', '=', $request->semester],
                ['section', '=', $request->section],
                ['hour', '=', $request->hour]
            ])->get();

            return response()->json($CurrentRecords);
        }else{
            $STrecord = StudentAttendanceRecord::find($IfHour->id);
            if($request->status === "absent" || $request->status === "leave"){
                $STrecord->is_present = false;
            }else{
                $STrecord->is_present = true;
            }
            $STrecord->status = $request->status;
            $STrecord->save();

            $CurrentRecords = StudentAttendanceRecord::where([
                ['date', '=', $request->date],
                ['degree', '=', $request->degree],
                ['department', '=', $request->department],
                ['year', '=', $request->year],
                ['semester', '=', $request->semester],
                ['section', '=', $request->section],
                ['hour', '=', $request->hour]
            ])->get();

            return response()->json($CurrentRecords);
        } 
    }

    public function setStudentStatusEveryHourAll(Request $request){

        $aca = Academic::find(1);

        $Students = $request->students;

        foreach ($Students as $Student) {
           
        $IfHour = StudentAttendanceRecord::where([
            ['student_id', '=', $Student['id']],
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

            $CreateHour->schedule_id = $request->schedule_id;
            $CreateHour->student_id =  $Student['id'];
            $CreateHour->date = $request->date;
            $CreateHour->hour = $request->hour;

            if($request->status === "absent" || $request->status === "leave"){
                $CreateHour->is_present = false;
            }else{
                $CreateHour->is_present = true;
            }

            $CreateHour->status = $request->status;
            $CreateHour->semester_start = $aca->semester_start;
            $CreateHour->save();
            // return response()->json($CreateHour);
        }else{
            $STrecord = StudentAttendanceRecord::find($IfHour->id);
            if($request->status === "absent" || $request->status === "leave"){
                $STrecord->is_present = false;
            }else{
                $STrecord->is_present = true;
            }
            $STrecord->status = $request->status;
            $STrecord->save();
            // return response()->json('all success');
        } 
    }
        $CurrentRecords = StudentAttendanceRecord::where([
                ['date', '=', $request->date],
                ['degree', '=', $request->degree],
                ['department', '=', $request->department],
                ['year', '=', $request->year],
                ['semester', '=', $request->semester],
                ['section', '=', $request->section],
                ['hour', '=', $request->hour]
            ])->get();

            return response()->json($CurrentRecords);
    }


// RETURN RECORDS BY DATES FROM AND TO
    public function StudentStatusByDate(Request $request){
        $aca = Academic::find(1);
        $getRecords = StudentAttendanceRecord::where([
            ['date', '>=', $request->fromdate],
            ['date', '<=', $request->todate],
            ['degree', '=', $request->degree],
            ['department', '=', $request->department],
            ['year', '=', $request->year],
            ['semester', '=', $request->semester],
            ['section', '=', $request->section],
            ['semester_start', '=', $aca->semester_start]
        ])->get();

        $Dates = StudentAttendanceDate::where([
            ['date', '>=', $request->fromdate],
            ['date', '<=', $request->todate],
            ['degree', '=', $request->degree],
            ['department', '=', $request->department],
            ['year', '=', $request->year],
            ['semester', '=', $request->semester],
            ['section', '=', $request->section],
            ['semester_start', '=', $aca->semester_start]
        ])->get();

        $res = ['dates'=>$Dates,'records'=>$getRecords];

        return response()->json($res);
        
    }


// RETURN RECORDS BY DAY
    public function StudentStatusDay(Request $request){
        $aca = Academic::find(1);
        $getRecords = StudentAttendanceRecord::where([
            ['date', '=', $request->date],
            ['degree', '=', $request->degree],
            ['department', '=', $request->department],
            ['year', '=', $request->year],
            ['semester', '=', $request->semester],
            ['section', '=', $request->section],
            ['semester_start', '=', $aca->semester_start]
        ])->get();

        $Dates = StudentAttendanceHour::where([
            ['date', '=', $request->date],
            ['degree', '=', $request->degree],
            ['department', '=', $request->department],
            ['year', '=', $request->year],
            ['semester', '=', $request->semester],
            ['section', '=', $request->section],
            ['semester_start', '=', $aca->semester_start]
        ])->get();

        $res = ['hours'=>$Dates,'records'=>$getRecords];

        return response()->json($res);
        
    }


//RETURN OVERALL RECORDS
    public function StudentStatusOverall(Request $request){
        $aca = Academic::find(1);
        $getRecords = StudentAttendanceRecord::where([
            ['degree', '=', $request->degree],
            ['department', '=', $request->department],
            ['year', '=', $request->year],
            ['semester', '=', $request->semester],
            ['section', '=', $request->section],
            ['semester_start', '=', $aca->semester_start]
        ])->get();

        $Dates = StudentAttendanceHour::where([
            ['degree', '=', $request->degree],
            ['department', '=', $request->department],
            ['year', '=', $request->year],
            ['semester', '=', $request->semester],
            ['section', '=', $request->section],
            ['semester_start', '=', $aca->semester_start]
        ])->get();

        $res = ['hours'=>$Dates,'records'=>$getRecords];
        return response()->json($res); 
    }
//RETURN SUBJECT RECORDS
    public function StudentStatusSubject(Request $request){
        $aca = Academic::find(1);

        $SChedules = StudentSubject::find($request->subject_id)->studentschedule;

        $THours = [];

        foreach ($SChedules as $SChedule) {
           $Hours = StudentAttendanceHour::where([
                ['degree', '=', $request->degree],
                ['department', '=', $request->department],
                ['year', '=', $request->year],
                ['semester', '=', $request->semester],
                ['section', '=', $request->section],
                ['semester_start', '=', $aca->semester_start],
                ['schedule_id', '=', $SChedule->id]
            ])->get();

            foreach ($Hours as $Hour) {
                array_push($THours, $Hour);
            }
            
        }
        $records = [];
        foreach ($SChedules as $SChedule) {
            $Hours = StudentAttendanceRecord::where([
                 ['degree', '=', $request->degree],
                 ['department', '=', $request->department],
                 ['year', '=', $request->year],
                 ['semester', '=', $request->semester],
                 ['section', '=', $request->section],
                 ['semester_start', '=', $aca->semester_start],
                 ['schedule_id', '=', $SChedule->id],
                 ['is_present', '=', 1]
             ])->get();

             foreach ($Hours as $Hour) {
                 array_push($records, $Hour);
             }

         }


$res = ['total_hours'=>$THours,'records'=>$records];

        return response()->json($res); 
    }



}
