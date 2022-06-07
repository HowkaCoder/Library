<?php

namespace App\Http\Controllers;

use App\Models\Facultet;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
   {
       $groups = Group::select('groups.id as groups_id', 'facultets.id as facultet_id', 'facultets.name as fac_name', 'groups.name as group_name')
       ->join('facultets', 'facultets.id', 'groups.facultet_id')
       ->get();
       
       
        return $groups;
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
            "facultet_id"=>"required|exists:App\Models\Facultet,id"
        ]);
        if($validator->fails()){
            return $this->ErrorResponce($validator->errors()->first());
        }
        Group::create([
            "name"=>$request->name,
            "facultet_id"=>$request->facultet_id
        ]);
        return $this->SuccessResponce();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        $id = $group->id;
        Group::where('id' , $id)->delete();
        return $this->SuccessResponce();
    }
}
