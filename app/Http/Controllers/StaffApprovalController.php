<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

use App\StaffApproval;
use App\Academic;


class StaffApprovalController extends Controller
{


    public function main(){
        return view('staffapprovals.index');
    }

    public function show(){
        return view('staffapprovals.show');
    }

    public function Admin(){
        return view('staffapprovals.adminview');
    }

    public function getAllApprovals(){
        $aca = Academic::find(1);

        $mApprovals = StaffApproval::where([
            ['year_start', '=', $aca->year_start],
            ['approved_by', '=', 0],
        ])->get();

        return response()->json($mApprovals);
    }


    public function getMyApprovals(Request $request){
        $mApprovals = StaffApproval::where('staff_id', $request->staff_id)->get();

        return response()->json($mApprovals);
    }
        

    public function store(Request $request){

        $aca = Academic::find(1);

        $ifExists = StaffApproval::where([
            ['date', '=', $request->date],
            ['staff_id', '=', $request->staff_id]
        ])->first();
        
        if($ifExists === null){
            $approval = new StaffApproval;
            $approval->date = $request->date;
            $approval->staff_id = $request->staff_id;
            $approval->approval_for = $request->approval_for;
            $approval->status = 'waiting';
            $approval->approved_by = 0;
            $approval->year_start = $aca->year_start;
            $approval->save();
            return response()->json($approval);
        }else{
            return response()->json('exists');
        }
        
    }

    public function updateApproval(Request $request){

        $approval = StaffApproval::find($request->approval_id);
        $approval->status = $request->status;
        $approval->approved_by = $request->approved_by;
        $approval->save();

        return response()->json($approval);
    }

    public function destroy(Request $request){

        if(StaffApproval::find($request->approval_id)){
            $approval = StaffApproval::find($request->approval_id);
            $approval->delete();
            
            return response()->json('removed');
        }
        
    }


    



}