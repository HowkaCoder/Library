<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Student::select("students.name as Name " , "password" , "groups.name as Group" , "facultets.name as Facultet")
        ->join('groups' , 'groups.id' , 'students.group_id')
        ->join('facultets' , 'facultets.id' , 'groups.facultet_id')
        ->get();
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all() , [
            "name"=>"required",
            "password"=>"required",
            "group_id"=>"required|exists:App\Models\Group,id"
        ]);
        if($validator->fails()){
            return $this->ErrorResponce($validator->errors()->first());
        }
        Student::create([
            "name"=>$request->name,
            "password"=>Hash::make($request->password),
            "group_id"=>$request->group_id
        ]);
        return $this->SuccessResponce();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        
        $id = $student->id;
        Student::where('id' , $id)->delete();
        return $this->SuccessResponce();
    }
}
