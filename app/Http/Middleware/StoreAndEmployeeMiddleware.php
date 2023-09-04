<?php

namespace App\Http\Middleware;

use App\Exceptions\ResourceNotFoundException;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;


class StoreAndEmployeeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->header('Authorization')) {

            $token = str_replace('Bearer ', '', $request->header('Authorization'));

            $apy = JWTAuth::getPayload($token);

            dd($apy);

        } else {
            //  throw new ResourceNotFoundException("Token not exits !", 'Token_not_fond');
        }

        return $next($request);
    }
}
