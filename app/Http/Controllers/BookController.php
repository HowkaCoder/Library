<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Book::select("newbooks.name as Name" , "count" , "authors.name as Author_Name" , "janres.name as Janre")
        ->join('authors' ,'authors.id' , 'newbooks.author_id' )
        ->join('janres' , 'janres.id' , 'newbooks.janre_id')
        ->get();
        return $data;
        return "fwofkwep";
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
            "count"=>"required",
            "author_id"=>'required|exists:App\Models\Author,id',
            "janre_id"=>'required|exists:App\Models\Janre,id'
        ]);
        if($validator->fails()){
            
            return $this->ErrorResponce($validator->errors()->first());
        }
        Book::create([
            "name"=>$request->name,
            "count"=>$request->count,
            "author_id"=>$request->author_id,
            "janre_id"=>$request->janre_id
        ]);
        return $this->SuccessResponce();
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        Book::where('id' , $book->id)->delete();
        return $this->SuccessResponce();
    }
}
