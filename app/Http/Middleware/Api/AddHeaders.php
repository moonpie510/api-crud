<?php

namespace App\Http\Middleware\Api;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AddHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $memoryCheck = memory_get_peak_usage(true) / 1024;
        $startCheckingTime = microtime(true);
        $response = $next($request);
        $endCheckingTime = microtime(true);

        $response->headers->set('X-Debug-Memory', $memoryCheck);
        $response->headers->set('X-Debug-Time', ($endCheckingTime - $startCheckingTime) * 1000);

        return $response;
    }
}
