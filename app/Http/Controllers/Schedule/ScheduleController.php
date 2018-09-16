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
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('schedule.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function assignShedule()
    {
        return view('schedule.assign');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view()
    {
        return view('schedule.view');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
