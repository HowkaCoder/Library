<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthorController extends Controller
{
     
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->SuccessResponce(Author::all());
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
            return $this->ErrorResponce($validator->errors()->first() , 419);
        }
        Author::create([
            "name"=>$request->name
        ]);
        return $this->SuccessResponce();
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        $data = Author::select('authors.id as author_id' , 'newbooks.id as book_id' , 'authors.name as Name'  , 'newbooks.name as Book_Name')
        ->join('newbooks' , 'newbooks.author_id' , 'authors.id')
        ->where('authors.id' , $author->id)
        ->get();
        return $this->SuccessResponce($data);
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Author $author)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        $author->delete();
        return $this->SuccessResponce();
    }
}
