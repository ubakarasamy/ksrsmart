<?php

namespace App\Http\Controllers\Schedule;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use App\Academic;
use App\StudentSubject;
use App\User;
use App\Student;


class SubjectController extends Controller
{
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $aca = Academic::findOrFail(1);

        $subject = new StudentSubject;
        $subject->degree = $request->degree;
        $subject->department = $request->department;
        $subject->year = $request->year;
        $subject->semester = $request->semester;
        $subject->section = $request->section;
        $subject->subject_id = $request->subject_id;
        $subject->subject_name = $request->subject_name;
        $subject->user_id = User::where('eid',$request->staff_id)->first()->id;
        $subject->semester_start = $aca->semester_start;
        $subject->save();

        if($subject->save()){
            return response()->json('success');
        }else{
            return response()->json('failed');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $aca = Academic::findOrFail(1);

        $subjects = StudentSubject::where('semester_start', $aca->semester_start)->get();

        foreach ($subjects as $subject) {
            $subject->staff_name = User::find($subject->user_id)->name;
        }

        return response()->json($subjects);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
