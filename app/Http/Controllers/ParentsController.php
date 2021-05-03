<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Student;
use App\Models\Parents;


class ParentsController extends Controller
{

    /**
    * Create a new parent in the system
    *
     **/
    public function create(Request $request){
        $student = Student::find($request->id);
        $stateOptions = ['NC'=>'North Carolina'];

        return view('pages.parents.create')->with(['student'=>$student,'stateOptions'=>$stateOptions]);
    }

    /**
     * Edit a resource in the system.
     */
    public function edit($id){
        $parents = Parents::find($id);
        $student = Students::find($parents->student_id);
        $stateOptions = ['NC'=>'North Carolina'];
        return view('pages.parents.edit')->with(['student'=>$student,'parent'=>$parents,'stateOptions'=>$stateOptions]);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $validator = \Validator::make($data, [
            'student_id' => 'required',
            'parent_first_name' => 'required|max:255',
            'parent_last_name' => 'required|max:255',
            'address_line_1' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required'
        ]);

        //Validation
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $parent = Parents::create($data);

        //GO back to the student edit page; now that we have parent information.
        return redirect()->route('students.edit',[$parent->student_id])->with('flash_success','New Parent Added!');

    }


    /**
     * Delete a parent in the system.
     */

    public function destroy($id)
    {
        $myParent = Parents::find($id);

        $myParent->delete();

        return back()->with('flash_success','Parent Deleted!');
    }


}
