<?php

namespace App\Exceptions;

use BadMethodCallException;
use Exception;
//use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Exception
     */
    public function render($request, Exception $exception)
    {
        // dd($exception);
        if($exception instanceof ModelNotFoundException) {
            return response()->json([
                'message'   =>  'errors',
                'data'      =>  'Cannot find the requested model',
                'status'    =>  Response::HTTP_FORBIDDEN
            ], Response::HTTP_FORBIDDEN);
        }
        if($exception instanceof NotFoundHttpException) {
            return response()->json([
                'message'   =>  'errors',
                'data'      =>  'The requested endpoint does not exist',
                'status'    =>  Response::HTTP_BAD_GATEWAY
                
            ], Response::HTTP_BAD_GATEWAY);
        }
        if($exception instanceof MethodNotAllowedHttpException) {
            return response()->json([
                'message'   =>  'errors',
                'data'      =>  'The HTTP request method isn\'t allowed on this endpoint',
                'status'    =>  Response::HTTP_METHOD_NOT_ALLOWED
                
            ], Response::HTTP_METHOD_NOT_ALLOWED);
        }
        if($request ->expectsJson()) {
            if($exception instanceof RouteNotFoundException) {
                return response()->json([
                    'message'   =>  'errors',
                    'data'      =>  'The requested endpoint does not exist',
                    'status'    =>  Response::HTTP_INTERNAL_SERVER_ERROR
                   
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
        if ($exception instanceof BadMethodCallException) {
            return response()->json([
                'message'   =>  'errors',
                'data'      =>  'The requested endpoint does not exist',
                'status'    =>  Response::HTTP_INTERNAL_SERVER_ERROR
               
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        if ($exception instanceof RouteNotFoundException) {
            return response()->json([
                'message'   =>  'errors',
                'data'      =>  'The requested endpoint does not exist',
                'status'    =>  Response::HTTP_INTERNAL_SERVER_ERROR
               
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        
        return parent::render($request, $exception);
    }
}
