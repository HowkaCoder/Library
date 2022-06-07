<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function SuccessResponce($message = "Success" , $code = 200 , $data = null){
        
        return response($message , $code);

    }

    public function ErrorResponce($message = "Error" , $code = 419 , $data = null){

        return response($message , $code);
    
    }
}
