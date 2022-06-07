<?php

namespace App\Http\Controllers;

use App\Models\Janre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JanreController extends Controller
{
    /** 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Janre::all();
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
            "name"=>"required"
        ]);
        if($validator->fails()){
            return $this->ErrorResponce($validator->errors()->first());
        }
        Janre::create([
            "name"=>$request->name
        ]);
        return $this->SuccessResponce();
          
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Janre  $janre
     * @return \Illuminate\Http\Response
     */
    public function show(Janre $janre)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Janre  $janre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Janre $janre)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Janre  $janre
     * @return \Illuminate\Http\Response
     */
    public function destroy(Janre $janre)
    {
        
        Janre::where('id' , $janre->id)->delete();
        return $this->SuccessResponce();
    }
}
