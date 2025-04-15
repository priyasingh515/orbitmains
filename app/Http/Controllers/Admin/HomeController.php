<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Contacts;
use DB;

class HomeController extends Controller
{
    //
    public function index(){
        $teacherId = Auth::id(); 
        $checkedStudents = DB::table('checked_answer_sheets')
            ->Join('answer_sheets','checked_answer_sheets.answer_sheet_id','=','answer_sheets.id')
            ->Join('users','users.id','=','answer_sheets.student_id')
            ->where('teacher_id', $teacherId)
            ->select('checked_answer_sheets.*','users.email as email','users.name as student_name','answer_sheets.status')
            ->count();
        $doubtsCount = DB::table('doubts')
           ->where('teacher_id',$teacherId)
            ->count();    
        return view('admin.dashboard',compact('checkedStudents','doubtsCount'));
    }

    public function enquery(){
        $enquery = Contacts::get();
        return view('admin.enquery',compact('enquery'));
    }

    // public function doubts(){
    //     $doubts = DB::table('doubts')
    //     ->leftJoin('users','users.id','=','doubts.user_id')
    //     ->leftJoin('answer_sheets','answer_sheets.id','=','doubts.answer_id')
    //     ->select(
    //         'doubts.*',
    //         'users.name',
    //         'users.email',
    //         'answer_sheets.answer_pdf',
    //         'users.name as teacher'
    //         )
    //     ->get();
    //     return view('admin.doubt',compact('doubts'));
    // }


    public function doubts()
    {
        $doubts = DB::table('doubts')
            ->leftJoin('users as students', 'students.id', '=', 'doubts.user_id')
            ->leftJoin('users as teachers', function($join) {
                $join->on('teachers.id', '=', 'doubts.teacher_id')
                    ->where('teachers.role', '=', 3);
            })
            ->leftJoin('answer_sheets', 'answer_sheets.id', '=', 'doubts.answer_id')
            ->Join('checked_answer_sheets', 'checked_answer_sheets.answer_sheet_id', '=', 'doubts.answer_id')
            ->select(
                'doubts.*',
                'students.name as student_name',
                'students.email as student_email',
                'teachers.name as teacher_name',
                'answer_sheets.answer_pdf',
                'checked_answer_sheets.checked_file_path as check_file'
            )
            ->get();

        return view('admin.doubt', compact('doubts'));
    }

    public function enqDlt($id)
    {
        $enqdlt = Contacts::findOrFail($id);
        $enqdlt->delete();

        return redirect()->route('enquerylist.index')->with('success', 'Enquiry deleted successfully!');

    }
    public function doubtDlt($id)
    {
        DB::table('doubts')->where('id', $id)->delete();

        return redirect()->route('Doubtlist.index')->with('success', 'Doubt deleted successfully!');
    }
    
    public function logout(){
        $admin =Auth::guard('admin')->logout();
        return redirect()->route('admin.login');

      }
}
