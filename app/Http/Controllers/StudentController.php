<?php

namespace App\Http\Controllers;

use App\Student;
use App\StudentSubject;
use App\StudentSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('student.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('student.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:student',
            'department' => 'required|max:255',
        ]);

        $stud = new Student;
        $stud->name = $request->name;
        $stud->email = $request->email;
        $stud->reg_no = $request->reg_no;
        $stud->degree = $request->degree;
        $stud->department = $request->department;
        $stud->year = $request->year;
        $stud->semester = $request->semester;
        $stud->section = $request->section;
        $stud->status = $request->status;
        $stud->save();

        if($stud->save()){
            return response()->json('success');
        }else{
            return response()->json('failed');
        }
        

    }
 /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function showAll()
    {
        $students = Student::where('status', 'current')->get();
        return response()->json($students);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Requset $request)
    {
        $students = Student::where('status', 'current')->get();
        return response()->json($students);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        return view('student.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $stud = Student::findOrFail($request->student_id);
        $stud->name = $request->name;
        $stud->email = $request->email;
        $stud->reg_no = $request->reg_no;
        $stud->degree = $request->degree;
        $stud->department = $request->department;
        $stud->year = $request->year;
        $stud->semester = $request->semester;
        $stud->section = $request->section;
        $stud->status = $request->status;
        $stud->save();

        if($stud->save()){
            return response()->json('success');
        }else{
            return response()->json('failed');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }

    public function test()
    {
 
        $comments = StudentSubject::find(8)->studentschedule;

foreach ($comments as $comment) {
    print_r($comment->day);
    print_r($comment->hour);
}
    

            $sub = StudentSchedule::find(22)->studentsubject;

            return $sub->subject_id;
}

}



