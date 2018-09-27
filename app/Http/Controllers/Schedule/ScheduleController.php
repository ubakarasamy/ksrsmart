<?php

namespace App\Http\Controllers\Schedule;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use App\StudentSchedule;
use App\Academic;
use App\StudentSubject;

class ScheduleController extends Controller
{
    
    public function store(Request $request)
    {
        $aca = Academic::findOrFail(1);

        $ifExists = StudentSchedule::where([
            ['degree', '=', $request->degree],
            ['department', '=', $request->department],
            ['year', '=', $request->year],
            ['semester', '=', $request->semester],
            ['section', '=', $request->section],
            ['day', '=', $request->Day_selected],
            ['hour', '=', $request->Hour_selected],
            ['semester_start', '=', $aca->semester_start]
        ])->first();
        if($ifExists === null){

        $schedule = new StudentSchedule;
        $schedule->degree = $request->degree;
        $schedule->department = $request->department;
        $schedule->year = $request->year;
        $schedule->semester = $request->semester;
        $schedule->section = $request->section;
        $schedule->staff_id = $request->staff_id;
        $schedule->day = $request->Day_selected;
        $schedule->hour = $request->Hour_selected;
        $schedule->student_subject_id = $request->Subject_selected;
        $schedule->semester_start = $aca->semester_start;
        $schedule->save();

        return response()->json('created');
        }
        else{
            $schedule = StudentSchedule::where([
                ['degree', '=', $request->degree],
            ['department', '=', $request->department],
            ['year', '=', $request->year],
            ['semester', '=', $request->semester],
            ['section', '=', $request->section],
            ['day', '=', $request->Day_selected],
            ['hour', '=', $request->Hour_selected],
            ['semester_start', '=', $aca->semester_start]
            ])->first();
        $schedule->degree = $request->degree;
        $schedule->department = $request->department;
        $schedule->year = $request->year;
        $schedule->semester = $request->semester;
        $schedule->section = $request->section;
        $schedule->day = $request->Day_selected;
        $schedule->hour = $request->Hour_selected;
        $schedule->staff_id = $request->staff_id;
        $schedule->student_subject_id = $request->Subject_selected;
        $schedule->semester_start = $aca->semester_start;
        $schedule->save();
        return response()->json($request);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showAllSchedules()
    {
        $aca = Academic::findOrFail(1);

        $schedules = StudentSchedule::where('semester_start', $aca->semester_start)->get();

        foreach ($schedules as $schedule) {

            $schedule->subject_name = StudentSubject::find($schedule->student_subject_id)->subject_name;

        }

        return response()->json($schedules);

    }


}
