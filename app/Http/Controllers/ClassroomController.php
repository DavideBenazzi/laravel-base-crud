<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classroom;
use Illuminate\Validation\Rule;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classrooms = classroom::all();
        return view('classrooms.index' , compact('classrooms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('classrooms.create');
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
        // VALIDATION
        $request->validate([
            'name' => 'required|unique:classrooms|max:10',
            'description' => 'required',
        ]);
        // SAVE DATA TO DB
        $classroom = new Classroom();
        // $classroom->name = $data['name'];
        // $classroom->description = $data['description'];
        $classroom->fill($data);  //<---- need fillable in model!!!

        $saved = $classroom->save();
        // REDIRECT
        if ($saved) {
            return redirect()->route('classrooms.show' , $classroom->id);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $classroom = Classroom::find($id);
        return view('classrooms.show' , compact('classroom'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $classroom = Classroom::find($id);
        return view('classrooms.edit' , compact('classroom'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // DATA FROM FORM
        $data = $request->all();
        // SPECIFIC INSTANCE
        $classroom = Classroom::find($id);
        // VALIDATION
        $request->validate([
            'name' => [
                'required',
                Rule::unique('classrooms')->ignore($id),
                'max:10',
            ],
            'description' => 'required',
        ]);

        // DATABASE UPDATE
        $updated = $classroom->update($data); //<---- need fillable in model!!! 

        if($updated) {
            return redirect()->route('classrooms.show', $id);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $classroom = Classroom::find($id);
        // REFERENCE FOR AN ALERT
        $ref = $classroom->name;
        $deleted = $classroom->delete();

        if ($deleted) {
            return redirect()->route('classrooms.index')->with('deleted' , $ref);
        }
    }
}
