<?php

namespace App\Http\Middleware;

use App\Models\Key;
use App\Models\Token;
use Closure;

class VerifyAPI
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
        $header = $request->hasHeader('bearer');
        if ($header) {
            $theKey = $request->header('bearer');

            $keyAuth = Token::where('key', $theKey)->where('active', true)->first();

            if ($keyAuth) {
                $request->user = $keyAuth->user;
                return $next($request);
            } else {
                return response()->json([
                    'error' => true,
                    'code' => 401,
                    'message' => 'Authentication failed. Your Bearer token is invalid.'
                ]);
            }
        } else {
            return response()->json([
                'error' => true,
                'code' => 401,
                'message' => 'Authentication failed. Bearer token does not exist.'
            ]);
        }
    }
}
