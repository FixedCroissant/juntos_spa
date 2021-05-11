<?php

namespace App\Http\Controllers;

use App\Models\StudentNote;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentNotesController extends Controller
{


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $student = Student::find($request->student);
        return view('pages.student_notes.create')->with(['student'=>$student]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $user=Auth::user();

        $validator = \Validator::make($data, [
            'student_note_text' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $studentNote=StudentNote::create(['student_id'=>$request->student_id,'user_id_completed'=>$user->id,'student_note_text'=>$request->student_note_text]);

        //GO back to the student edit page; now that we have parent information.
        return redirect()->route('students.edit',[$studentNote->student_id])->with('flash_success','Student Note Created');

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $studentNote = StudentNote::find($id);

        return view('pages.student_notes.edit')->with(['studentNote'=>$studentNote]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StudentNote  $studentNote
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $data = $request->all();

        $validator = \Validator::make($data, [
            'student_note_text' => 'required',
        ]);

        //Validation
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $studentNote=StudentNote::create($data);

        //GO back to the student edit page; now that we have parent information.
        return redirect()->route('students.edit',[$studentNote->student_id])->with('flash_success','Student Note Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $StudentNote = StudentNote::find($id);
        $StudentNote->delete();

        return back()->with('flash_success','Student Deleted!');

    }
}
