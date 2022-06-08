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
        $data = Student::select( "students.id as Student_Id" , "groups.id as Group_Id","facultets.id as faculty_Id" ,  "students.name as Name " , "groups.name as Group" , "facultets.name as Facultet")
        ->join('groups' , 'groups.id' , 'students.group_id')
        ->join('facultets' , 'facultets.id' , 'groups.facultet_id')
        ->get();
        return $this->SuccessResponce($data);
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
            return $this->ErrorResponce($validator->errors()->first() , 419);
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
        // return $this->SuccessResponce($student);
        $data = Student::select('students.id as student_id' , 'newbooks.id as book_id' , 'groups.id as group_id','students.name as student_name' , 'groups.name as group_name' , 'newbooks.name as book_name')
        ->join('transaktions' , 'transaktions.student_id' , 'students.id')
        ->join('groups' , 'groups.id' , 'students.group_id')
        ->join('newbooks' , 'newbooks.id' , 'transaktions.book_id')
        ->where('students.id' , $student->id)
        ->first();
        return $data;
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
        $student->delete();
        return $this->SuccessResponce();
    }
}
