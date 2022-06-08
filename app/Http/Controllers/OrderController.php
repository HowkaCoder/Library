<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data = Order::select("transaktions.id as ID" , 'books.name as Book' , 'students.name as Student' , 'count' , 'transaktions.created_at as created_at')
        // ->join('books' , 'books.id' , 'transaktions.book_id')
        // ->join('students' , 'students.id' , 'transaktions.student_id')
        // ->where('transaktions.status' , "created")
        // ->get();
        // return $this->SuccessResponce($data);
        return $this->SuccessResponce(Order::where('status' , 'created')->get());
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
            "count"=>"required",
            "book_id"=>"required|exists:App\Models\Book,id",
            "student_id"=>"required|exists:App\Models\Student,id"
        ]);
        if($validator->fails()){
            return $this->ErrorResponce($validator->errors()->first() , 419);
        }
        $book = Book::where('id',$request->book_id)->get();
        $count = $request->count;
        foreach($book as $value){
            $zero = $value->count - $count;
            if($zero < 0 ) {
            return $this->ErrorResponce("Не осталось книг" , 319);
            }else{   

            Order::create([
            "count"=>$request->count,
            "book_id"=>$request->book_id,
            "student_id"=>$request->student_id,
            "status"=>"created"
            
        ]);
            Book::where('id' , $value->id)->update([
                "count"=>$zero
            ]);
            // return $value;
            return $this->SuccessResponce();
            }
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return $this->SuccessResponce($order);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        Order::where('id' , $order->id)->update([
            "status"=> 'deleted'
        ]);
        $zero = Order::select('count')->where('id' , $order->id)->get();

        $law = Book::select('count')->where('id' , $order->book_id)->get();
        
        foreach($zero as $count){
            foreach($law as $polo){
            Book::where('id' , $order->book_id)->update([
                // return $polo ->count;
                "count"=>$polo->count + $count->count
        
            ]);
            // return $polo->count + $count->count;
        
            return $this->SuccessResponce();
            }
        }
    }
}
