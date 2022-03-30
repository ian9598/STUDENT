<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentInfo;
use DB;

class StudentInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $student = DB::select(' SELECT *, (SELECT AVG(mark) FROM student_result AS r WHERE r.student_id = i.student_id ) AS avgMark FROM student_info AS i');
        
        return view('student_info.index')
        ->with('student', $student);

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
            'student_id' => 'required',
            'student_name' => 'required',
            'gender' => 'required',
            'ic' => 'required',
        ]);
         
        $s = StudentInfo::where('student_id', '=', $request->student_id)->first();

        if ($s === null) {
            $student = new StudentInfo();
            $student->student_id = $request->student_id;
            $student->student_name = $request->student_name;
            $student->gender = $request->gender;
            $student->ic = $request->ic;
            $student->save();

            return redirect('index')->with('success', 'Student successfully added!');

        } else {
            return redirect('index')->with('error', 'Student already exist!');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'student_id' => 'required',
            'student_name' => 'required',
            'gender' => 'required',
            'ic' => 'required',
        ]);

        $student = StudentInfo::findOrFail($request->student_id);
        $student->student_name = $request->student_name;
        $student->gender = $request->gender;
        $student->ic = $request->ic;
        $student -> update();

        return redirect('index')->with('success', 'Student successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($stud_id)
    {
        $student = StudentInfo::findOrFail($stud_id);
        $student->delete();

        return redirect('/index')->with('success', 'Student successfully deleted');
    }
}
