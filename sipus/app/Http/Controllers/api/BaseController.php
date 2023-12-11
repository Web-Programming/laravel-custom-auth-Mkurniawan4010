<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    //
    public function sendResponse ($result, $message){
        $response = [
            'success' => true,
            'data' => $result,
            'message' => $message,
        ];
        return response()->json($response, 200);
    }
    public function sendError ($error, $errorMessage = [], $code=404){
        $response = [
            'success' => true, //false,
            'message' => $error, //$errorMessage,
        ];

        if(!empty($errorMessage)){
            $response['data'] = $errorMessage;
        }
        return response()->json($response, $code);
    }

    public function index(){

    }
    public function store(Request $request){

    }
    public function show(string $id){

    }
    public function update(Request $request, string $id){

    }
    public function destroy(string $id){

    }
}
