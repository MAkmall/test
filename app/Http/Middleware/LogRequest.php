<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LogRequest
{
    public function handle(Request $request, Closure $next)
    {
        Log::info('Incoming Request', [
            'method' => $request->method(),
            'url' => $request->url(),
            'path' => $request->path(),
            'headers' => $request->headers->all(),
        ]);
        return $next($request);
    }
}