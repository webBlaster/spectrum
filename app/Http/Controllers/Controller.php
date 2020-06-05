<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // The response that wil be sent to the client
    public function sendResponse($message, $data, $status = 1){
        return response()->json([
            'message'   =>  $message,
            'data'      =>  $data,
            'status'    =>  $status
        ])->setStatusCode($status == 1 ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
    }

    // The success handler, this method is called whenever we want to return success
    public function success(string $message = null, $data = [], $status = 1) {
        return $this->sendResponse($message, $data, $status);
    }

    public function failed(string $message = null, $data = [], $status = 0) {
        return $this->sendResponse($message, $data, $status);
    }
}
