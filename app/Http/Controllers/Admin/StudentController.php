<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use DB;

class StudentController extends Controller
{
    
    public function index(){
        $student = DB::table('users')
            ->leftJoin('answer_sheets', 'users.id', '=', 'answer_sheets.student_id')
            ->select(
                'users.id', 
                'users.name', 
                'users.email', 
                DB::raw("COUNT(CASE WHEN answer_sheets.status = 'pending' THEN 1 END) as pending_count")
            )
            ->where('users.role', '1')
            ->where('users.state', 'cg')
            ->groupBy('users.id', 'users.name', 'users.email')
            ->get();
        
        return view('admin.student.index',compact('student'));
    }


    public function mpstudentList(){
        $student = DB::table('users')
            ->leftJoin('answer_sheets', 'users.id', '=', 'answer_sheets.student_id')
            ->select(
                'users.id', 
                'users.name', 
                'users.email', 
                DB::raw("COUNT(CASE WHEN answer_sheets.status = 'pending' THEN 1 END) as pending_count")
            )
            ->where('users.role', '1')
            ->where('users.state', 'mp')
            ->groupBy('users.id', 'users.name', 'users.email')
            ->get();
        
        return view('admin.student.mpstudent_list',compact('student'));
    }

    public function studentView($id)
    {
        $student = DB::table('answer_sheets')
            ->join('users', 'answer_sheets.student_id', '=', 'users.id') 
            ->leftJoin('checked_answer_sheets', 'answer_sheets.id', '=', 'checked_answer_sheets.answer_sheet_id')
            ->where('answer_sheets.student_id', $id)
            ->select(
                'answer_sheets.*', 'users.name', 'users.email','users.state',
                'checked_answer_sheets.checked_file_path as check_file',
                'checked_answer_sheets.created_at as checked_date'
            ) 
            ->get();

        if (!$student) {
            return redirect()->back()->with('error', 'Student not found!');
        }

        return view('admin.student.answerview', compact('student'));
    }

    public function ansswerEdit($id ,$type){

        $answerSheet = DB::table('answer_sheets')->find($id);
        
        return view('admin.student.answeredit',compact('answerSheet','type'));
    }


    public function assignToTeacher(Request $request)
    {
        $request->validate([
            'answer_sheet_id' => 'required|exists:answer_sheets,id',
            'teacher_id' => 'required|exists:users,id',
        ]);

        DB::table('assigned_teacher')->insert([
            'answersheet_id' => $request->answer_sheet_id,
            'teacher_id' => $request->teacher_id,
            
        ]);

        // Answer Sheet ka status update karein
        DB::table('answer_sheets')
            ->where('id', $request->answer_sheet_id)
            ->update(['status' => 'assigned']);

            return back()->with('success', 'Answer Sheet Assigned to Teacher');
        }

}
