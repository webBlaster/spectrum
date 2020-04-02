<?php

namespace App\Http\Middleware;

use Closure;
use App\DeveloperApiKey;
class ApiKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->apikey == '') {
            return response()->json([
                'message' => 'Please provide a valid API KEY',
                'data' => '',
                'status' => 0
            ]);
        } else {
            $apikey = DeveloperApiKey::where('key', $request->apikey)->count();
            if($apikey != 1) {
                return response()->json([
                    'message' => 'Invalid API KEY',
                    'data' => '',
                    'status' => 0
                ]);
            } else {
                return $next($request);
            }
        }   
        
    }
}
