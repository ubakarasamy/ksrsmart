<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('revalidate'); 
        $this->middleware('auth');
    }

    /**
     * Home page
     */
    public function index()
    {
        return view('home.index');
    }

    /**
     * Student pages
     */
    public function studentsIndex()
    {
        return view('student.index');
    }

    public function Studentcreate()
    {
        return view('student.create');
    }

    /**
     * Staff pages
     */
    public function StaffMyProfile(){
        return view('staff.myprofile');
    }

    public function Staffindex()
    {
        return view('staff.index');
    }

    public function Staffcreate()
    {
        return view('staff.create');
    }

    /**
     * Schedule pages
     */
    public function Scheduleindex()
    {
        return view('schedule.index');
    }
    public function ScheduleassignShedule()
    {
        return view('schedule.assign');
    }

    public function Scheduleview()
    {
        return view('schedule.view');
    }

    /**
     * Academic pages
     */
    public function Academicindex(){
        return view('academic.index');
    }

    /**
     * StudentAttendance pages
     */
    public function StudentAttendanceindex()
    {
        return view('studentattendance.make');
    }
    public function StudentAttendanceEditAt()
    {
        return view('studentattendance.edit');
    }
    
    public function StudentAttendanceviewByDay(){
        return view('studentattendance.viewbyday');
    }
    public function StudentAttendanceviewByMonth(){
        return view('studentattendance.viewbymonth');
    }
    public function StudentAttendanceviewByOverall(){
        return view('studentattendance.viewbyoverall');
    }
    public function StudentAttendanceviewBySubject(){
        return view('studentattendance.viewbysubject');
    }

    /**
     * StaffAttendance pages
     */

    public function StaffAttendanceindex(){
        return view('staffattendance.make');
    }

    public function StaffAttendanceEditAt()
    {
        return view('staffattendance.edit');
    }

    public function StaffAttendanceviewByDay(){
        return view('staffattendance.viewbyday');
    }
    public function StaffAttendanceviewByMonth(){
        return view('staffattendance.viewbymonth');
    }
    public function StaffAttendanceviewByOverall(){
        return view('staffattendance.viewbyoverall');
    }

    /**
     * StaffApproval pages
     */

    public function StaffApprovalmain(){
        return view('staffapprovals.index');
    }

    public function StaffApprovalshow(){
        return view('staffapprovals.show');
    }

    public function StaffApprovalAdmin(){
        return view('staffapprovals.adminview');
    }

}
