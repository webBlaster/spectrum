<?php

namespace App\Http\Middleware;

use Closure;

class OptionalToken
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
        $tokens = array('44b48f2305bf2680', 'a40d97bfc2ab0e56');
        if($request->header('Authorization')) {
            $token = $request->header('Authorization');

            //Check Token
            if(in_array($token, $tokens)) {
                return $next($request);
            } else {
                return response()->json([
                    'results' => 'API key is not valid'
                ]);
            }
        }
        return response()->json([
            'results' => 'Authorization Failed'
        ]);
    }
}
