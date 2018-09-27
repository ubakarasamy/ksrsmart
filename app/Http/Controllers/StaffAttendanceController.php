<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Academic;
use App\StaffAttendanceDate;
use App\StaffAttendanceRecord;
use App\StaffApproval;

class StaffAttendanceController extends Controller
{
    
    public function getAllatbydate(Request $request){
        $date = $request->makedate;
        $aca = Academic::find(1);
        $records = StaffAttendanceRecord::where('date', $date)->get();

        $Approvals = StaffApproval::where([
            ['year_start', '=', $aca->year_start],
            ['approved_by', '=', 1],
            ['date', '=', $date]
        ])->get();

        foreach ($Approvals as $Approval) {
            $user = User::find($Approval->staff_id);
            $Approval->staff_eid = $user->eid;
            $Approval->staff_name = $user->name;
        }

        return response()->json(['records' => $records, 'approvals' => $Approvals]);
    }

    public function getAttendancesbydates(Request $request){
        $records = StaffAttendanceRecord::where([
            ['date', '>=', $request->fromdate],
            ['date', '<=', $request->todate]
            ])->get();
        $dates = StaffAttendanceDate::where([
            ['date', '>=', $request->fromdate],
            ['date', '<=', $request->todate]
            ])->get();
            
        return response()->json(['dates'=>$dates,'records'=>$records]);
    }

    public function AllAts(){
        $aca = Academic::find(1);
        $records = StaffAttendanceRecord::where([
            ['year_start', '=', $aca->year_start]
            ])->get();
        $dates = StaffAttendanceDate::where([
            ['year_start', '=', $aca->year_start]
            ])->get();
            
        return response()->json(['year_start'=>$aca->year_start,'dates'=>$dates,'records'=>$records]);
    }

    


    

    public function storeDate(Request $request){

        $aca = Academic::find(1);

        $ifExists = StaffAttendanceDate::where([
            ['date', '=', $request->makedate]
        ])->first();

        if($ifExists === null){
            $Date = new StaffAttendanceDate;
            $Date->date = $request->makedate;

            $st = User::where('eid', $request->eid)->first();
            $Date->at_staff = $st->id;
            $Date->year_start = $aca->year_start;
            $Date->save();
            return response()->json($Date);
        }else{
            $OldDate = StaffAttendanceDate::where([
                ['date', '=', $request->makedate]
            ])->first();
            // $st = User::where('eid', $request->eid)->first();
            // $OldDate->at_staff = $st->id;
            // $OldDate->save();

            return response()->json($OldDate);

        }
        //return response()->json($request);
    }

    public function makeStaffAt(Request $request){

        $aca = Academic::find(1);
        
        $ifExists = StaffAttendanceRecord::where([
            ['date', '=', $request->makedate],
            ['staff_id', '=', $request->staff_id],
        ])->first();
        
        if($ifExists === null){
            $Record = new StaffAttendanceRecord;
            $Record->date = $request->makedate;
            $Record->staff_id = $request->staff_id;
            $Record->status = $request->status;

            if($request->status !== 'absent' || $request->status !== 'leave'){
                $Record->is_present = true;
            }else{
                $Record->is_present = false;
            }
            
            $Record->year_start = $aca->year_start;
            $Record->save();

        }else{
            $Record = StaffAttendanceRecord::where([
                ['date', '=', $request->makedate],
                ['staff_id', '=', $request->staff_id],
            ])->first();

            $Record->date = $request->makedate;
            $Record->staff_id = $request->staff_id;
            $Record->status = $request->status;

            if($request->status !== 'absent' || $request->status !== 'leave' && $Record->status !== 'absent' || $Record->status !== 'leave'){
                $Record->is_present = true;
            }else{
                $Record->is_present = false;
            }
            
            $Record->year_start = $aca->year_start;
            $Record->save();
        }

        return response()->json($request);

    }

    public function makeAllStaffAt(Request $request){

        $aca = Academic::find(1);

        $Staffs = $request->staffs;

        foreach ($Staffs as $Staff) {
            $ifExists = StaffAttendanceRecord::where([
                ['date', '=', $request->makedate],
                ['staff_id', '=', $Staff['id']],
            ])->first();
            
            if($ifExists === null){
                $Record = new StaffAttendanceRecord;
                $Record->date = $request->makedate;
                $Record->staff_id =  $Staff['id'];
                $Record->status = $request->status;
    
                if($request->status !== 'absent' || $request->status !== 'leave'){
                    $Record->is_present = true;
                }else{
                    $Record->is_present = false;
                }
                
                $Record->year_start = $aca->year_start;
                $Record->save();
    
            }else{
                $Record = StaffAttendanceRecord::where([
                    ['date', '=', $request->makedate],
                    ['staff_id', '=', $Staff['id']],
                ])->first();
    
                $Record->date = $request->makedate;
                $Record->staff_id =  $Staff['id'];
                $Record->status = $request->status;
    
                if($request->status === 'absent' || $request->status === 'leave'){
                    $Record->is_present = false;
                }elseif($request->status !== 'absent' || $request->status !== 'leave'){
                    $Record->is_present = true;
                }
                
                $Record->year_start = $aca->year_start;
                $Record->save();
            }
        }

     return response()->json($Record);
        
    }

}
