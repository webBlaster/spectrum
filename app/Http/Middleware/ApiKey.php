<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use App\DeveloperApiKey;
use Symfony\Component\HttpFoundation\Response;

class ApiKey
{
    public function handle($request, Closure $next)
    {

        $request->headers->set('Accept', 'application/json');
        $apikey = $request->header('APP-KEY');
        if($apikey == '') {
            return response()->json([
                'message' => 'APP-KEY is required to continue',
                'data' => '',
                'status' => 0
            ], Response::HTTP_UNAUTHORIZED);
        } else {
            $present = Carbon::now();
            $apikey = DeveloperApiKey::where('key', $apikey)->where('valid_from', '<=', $present)->where('valid_till', '>=', $present)->first();
            if(!$apikey) {
                return response()->json([
                    'message' => 'Invalid APP-KEY',
                    'data' => '',
                    'status' => 0
                ], Response::HTTP_UNAUTHORIZED);
            } else {
                return $next($request);
            }
        }   
        
    }
}
