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

use Illuminate\Auth\AuthenticationException;

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

    
    public function unauthenticated($request, AuthenticationException $exception) {
        return $request->expectsJson()
                ? response()->json([
                    'message'       => $exception->getMessage(),
                    'data'          => '',
                    'status'        => 0
                ], 401)
                : redirect()->guest($exception->redirectTo() ?? route('login'));
    }
    public function render($request, Exception $exception)
    {
        // dd($exception);
        // if( $request->expectsJson()) {
        //     if($exception instanceof ModelNotFoundException) {
        //         return response()->json([
        //             'message'   =>  'Cannot find the requested model',
        //             'data'      =>  '',
        //             'status'    =>  0
        //         ], Response::HTTP_FORBIDDEN);
        //     }
        // }
        
        // if( $request->expectsJson()) {
        //     if($exception instanceof NotFoundHttpException) {
        //         return response()->json([
        //             'message'   =>  'invalid url or endpoint specified (hint: ensure you attach an API KEY, enter a complete endpoint URL)',
        //             'data'      =>  '',
        //             'status'    =>  0
                    
        //         ], Response::HTTP_BAD_GATEWAY);
        //     }
        // }
       
        // if( $request->expectsJson()) {
        //     if($exception instanceof MethodNotAllowedHttpException) {
        //         return response()->json([
        //             'message'   =>  'The HTTP request method isn\'t allowed on this endpoint, Try another method (e.g: POST, GET, PUT(must have a target id), etc)',
        //             'data'      =>  '',
        //             'status'    =>  0
                    
        //         ], Response::HTTP_METHOD_NOT_ALLOWED);
        //     }
        // }
        
        // if($request ->expectsJson()) {
        //     if($exception instanceof RouteNotFoundException) {
        //         return response()->json([
        //             'message'   =>  'The Requested url does not exist',
        //             'data'      =>  '',
        //             'status'    =>  0
                   
        //         ], Response::HTTP_INTERNAL_SERVER_ERROR);
        //     }
        // }
        // if( $request->expectsJson()) {
        //     if ($exception instanceof BadMethodCallException) {
        //         return response()->json([
        //             'message'   =>  'Wrong Http request made, check if the request type is supported on this endpoint',
        //             'data'      =>  '',
        //             'status'    =>  0
                
        //         ], Response::HTTP_INTERNAL_SERVER_ERROR);
        //     }
        // }
        
        // if( $request->expectsJson()) {
        //     if ($exception instanceof RouteNotFoundException) {
        //         return response()->json([
        //             'message'   =>  'The requested endpoint does not exist',
        //             'data'      =>  '',
        //             'status'    =>  0
                
        //         ], Response::HTTP_INTERNAL_SERVER_ERROR);
        //     }
        // }
        
        
        return parent::render($request, $exception);
    }
}
