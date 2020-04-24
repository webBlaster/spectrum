<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use App\DeveloperApiKey;
class ApiKey
{
    public function handle($request, Closure $next)
    {
        if($request->apikey == '') {
            return response()->json([
                'message' => 'Please provide a valid API KEY',
                'data' => '',
                'status' => 0
            ]);
        } else {
            $present = Carbon::now();
            $apikey = DeveloperApiKey::where('key', $request->apikey)->where('valid_from', '<=', $present)->where('valid_till', '>=', $present)->first();
            if(!$apikey) {
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
