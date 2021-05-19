<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlumniController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $loggedInUser = auth()->user();
        $userSites=[];
        foreach($loggedInUser->studentAccess as $siteAccess){
            $userSites[]=$siteAccess->pivot->site_id;
        }
        $graduatedStudents = DB::table('students')
            ->leftJoin('sites','students.site_id','=','sites.id')
            ->select('students.*','sites.site_name')
            ->where('graduated',1)
            ->whereIn('site_id',$userSites)
            ->get();


        return view('pages.alumni.index')->with(['graduatedStudents'=>$graduatedStudents]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $student=Student::find($request->student);
        return view('pages.alumni.create')->with(['student'=>$student]);
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

        $validator = \Validator::make($data, [
            'student_id' => 'required',
            'alumni_notes' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        Alumni::create($data);

        return redirect()->route('alumni.index')->with('flash_success','New Alumni note Added!');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Alumni  $alumni
     * @return \Illuminate\Http\Response
     */
    public function edit(Alumni $alumni,$id)
    {

        $alumni = Alumni::find($id);

        //Note doesn't exit go back.
        if(is_null($alumni)){
            return back()->with(['flash_warning'=>'Please create note first. No longer exists']);
        }
        $student = Student::find($alumni->student_id);

        return view('pages.alumni.edit')->with(['alumni'=>$alumni,'student'=>$student]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Alumni  $alumni
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alumni $alumni, $id)
    {
        $data = $request->all();

        $validator = \Validator::make($data, [
            'alumni_notes' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $alumniNote= Alumni::find($id);

        $alumniNote->update($request->all());

        return redirect()->route('alumni.index')->with('flash_success','Alumni Notes Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $alumni = Alumni::find($id);
        $alumni->delete();

        return redirect()->route('alumni.index')->with('flash_success','Alumni Note Deleted!');

    }
}
