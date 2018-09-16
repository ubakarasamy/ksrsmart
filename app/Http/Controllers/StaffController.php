<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use App\User;
use App\Role;

class StaffController extends Controller
{

    public function MyProfile(){
        return view('staff.myprofile');
    }
 
    public function index()
    {
        return view('staff.index');
    }


    public function create()
    {
        return view('staff.create');
    }

    public function edit(Request $request)
    {
        return view('staff.edit');
    }

    public function showAll(Request $request)
    {
        $staffs = User::where('status', 'current')->get();
        return response()->json($staffs);
    }

    public function ProfileUpdate(Request $request){

        $user = User::find($request->user_id);
        $user->password = Hash::make($request->password);
        $user->email = $request->email; //user can only update password and email
        $user->save();

        return response()->json($request);
    }

    public function store(Request $request)
    {

        $staff = new User;
        $staff->name = $request->name;
        $staff->email = $request->email;
        $staff->eid = $request->eid;
        $staff->working_department = $request->working_department;
        $staff->dashboard_role = $request->dashboard_role;
        $staff->occupation = $request->occupation;
        $staff->status = 'current';
        $staff->password = Hash::make($request->password);
        $staff->save();

        $staff
       ->roles()
       ->attach(Role::where('name', $request->dashboard_role)->first());

        if($staff->save()){
            return response()->json($staff);
        }else{
            return response()->json('failed');
        }
    }

    public function update(Request $request)
    {
        $staff = User::find($request->staff_id);
        $staff->name = $request->name;
        $staff->email = $request->email;
        $staff->eid = $request->eid;
        $staff->working_department = $request->working_department;
        $staff->dashboard_role = $request->dashboard_role;
        $staff->occupation = $request->occupation;
        $staff->status = $request->status;
        $staff->password = Hash::make($request->password);
        $staff->save();

        $staff
       ->roles()
       ->attach(Role::where('name', $request->dashboard_role)->first());

        if($staff->save()){
            return response()->json($staff);
        }else{
            return response()->json('failed');
        }

    return response()->json($request);
    }

    

}



