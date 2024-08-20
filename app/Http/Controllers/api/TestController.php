<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Test;

class TestController extends Controller
{
    public function data(){
        $data = Test::all();
        $positive_response = [
            'status' => 200,
            'responeData' => $data,
        ];
        $negative_response = [
            'status' => 404,
            'responeData' => 'suck on no data.',
        ];

        if($data->count() > 0){
        return response()->json($positive_response,200);
        }
        else{
        return response()->json($negative_response,404);
            
        }
    }
}
