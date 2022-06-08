<?php

namespace App\Http\Controllers;

use App\Models\Facultet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FacultetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->SuccessResponce(Facultet::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            "name"=>"required"
        ]);
        if($validator->fails()){
            return $this->ErrorResponce($validator->errors()->first() , 419);
        }
        Facultet::create([
            "name"=>$request->name
        ]);
        return $this->SuccessResponce();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Facultet  $facultet
     * @return \Illuminate\Http\Response
     */
    public function show(Facultet $facultet)
    {
        return $this->SuccessResponce($facultet);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Facultet  $facultet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Facultet $facultet)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Facultet  $facultet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Facultet $facultet)
    {
        $facultet->delete();
        return $this->SuccessResponce();
    }
}
