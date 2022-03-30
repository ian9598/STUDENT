<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentResult;
use App\Models\StudentInfo;

class StudentResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($stud_id)
    {
        $s_ID = $stud_id;
        $avg = StudentResult::where('student_id', '=' , $s_ID)->avg('mark');
        $studentInfo = StudentInfo::where('student_id', '=' , $s_ID)->value('student_name');
        $studentResult = StudentResult::where('student_id', '=' , $s_ID)->get();
        
        return view('student_result.index')
        ->with('s_ID', $s_ID)
        ->with('avg', $avg)
        ->with('studentInfo', $studentInfo)
        ->with('studentResult', $studentResult);
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
            'sID' => 'required',
            'course' => 'required',
            'mark' => 'required',
        ]);
         
        $r = StudentResult::where('course', '=', $request->course)
        ->where('student_id', '=', $request->sID)->first();

        if ($r === null) {
            $studentResult = new StudentResult();
            $studentResult->student_id = $request->sID;
            $studentResult->course = $request->course;
            $studentResult->mark = $request->mark;
            $studentResult->save();

            return back()->with('success', 'Result successfully added!');

        } else {
            return back()->with('error', 'Result already exist!');
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
            'sID' => 'required',
            'result_id' => 'required',
            'course' => 'required',
            'mark' => 'required',
        ]);
         
        $studentResult = StudentResult::findOrFail($request->result_id);
        $studentResult->course = $request->course;
        $studentResult->mark = $request->mark;
        $studentResult->student_id = $request->sID;
        $studentResult -> update();

        return back()->with('success', 'Result successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($result_id)
    {
        $studentResult = StudentResult::findOrFail($result_id);
        $studentResult->delete();

        return back()->with('success', 'Result successfully deleted');
    }
}
