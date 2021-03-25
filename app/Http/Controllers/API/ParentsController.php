<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Parents;
use App\Http\Resources\ParentsResource;
use Illuminate\Http\Request;
use DB;

class ParentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
             $parents = Parents::with(['student' => function($query) {
                 return $query->select(['id','student_first_name','student_last_name',DB::raw('CONCAT(student_first_name, " ", student_last_name) AS student_full_name')]);
                 }])->select(
                    'id',DB::raw('CONCAT(parents.parent_first_name, " ", parents.parent_last_name) AS parent_full_name'),
                    'city','student_id','address_line_1','city','state','zip',
                 )->get();

        return response([ 'parents' => ParentsResource::collection($parents), 'message' => 'Retrieved successfully'], 200);
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
             'parent_first_name' => 'required|max:255',
             'parent_last_name' => 'required|max:255',
             'address_line_1' => 'required',
             'city' => 'required',
             'state' => 'required',
             'zip' => 'required'
         ]);

        //Validation
         if($validator->fails()){
             return response(['error' => $validator->errors(), 'Validation Error']);
         }

        $parent = Parents::create($data);

        return response([ 'parent' => new ParentsResource($parent), 'message' => 'Created Parent','status'=>200], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Parents  $parents
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Find Information about our parents.
        $myParent = Parents::find($id);
        
        //->select('parent_first_name','parent_last_name','address_line_1','city','state','zip');


        return response([ 'parent' => new ParentsResource($myParent), 'message' => 'Retrived Parent','status'=>200], 200);
    }

    

    /**
     * Update the specified resource in storage.
     *
     * Needs to pass the id of the parent for the proper
     * update to occur
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Parents  $parents
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $parentID)
    {
        $myParents = Parents::find($parentID);

        //Update our parent
        $myParents->update($request->all());

        return response([ 'parents' => new ParentsResource($myParents), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Parents  $parents
     * @return \Illuminate\Http\Response
     */
    public function destroy(Parents $parents, $id)
    {
        $myParent = Parents::find($id);

        $myParent->delete();

        return response(['message' => 'Parent Deleted'],200);
    }
}
