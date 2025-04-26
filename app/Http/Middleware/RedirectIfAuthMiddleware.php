<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class RedirectIfAuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        try {
            $token = session()?->get('token');
        } catch (NotFoundExceptionInterface $e) {
            Log::error('Error retrieving token from session: ' . $e->getMessage());
        } catch (ContainerExceptionInterface $e) {
            Log::error('Container exception: ' . $e->getMessage());
        }

        if (isset($token) && $token) {
            return redirect()->route('home');
        }
        return $next($request);
    }
}
