<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class StaffController extends Controller
{
 
    public function index()
    {
        return view('staff.index');
    }


    public function create()
    {
        return view('staff.create');
    }

    public function edit(Student $student)
    {
        return view('staff.edit');
    }

    public function destroy(Student $student)
    {
        //
    }

    

}



