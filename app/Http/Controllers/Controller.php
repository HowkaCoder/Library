<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function SuccessResponce( $data = ['message'=>"Success"]){
        
        return response($data , 200 );

    }

    public function ErrorResponce( $data = "Error" , $code){

        return response(["message"=> $data] , $code);
    
    }
}
