<?php

namespace App\Http\Middleware\Autentication;

use Closure;
use Illuminate\Http\Request;

class AutenticationMiddleware
{
    protected $service;

    public function __construct(\App\Services\AutenticationService $autenticationService)
    {
        $this->service = $autenticationService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try {

            $token = $request->bearerToken();

            if (is_null($token))
            {
                return response()->json(['message' => 'Token não informado.'], 401);
            }

            return $next($request);

        } catch (\Exception $e) {            
            return response()->json(['message' => 'Token expirado.'], 401);
        }

        return $next($request);
    }
}
