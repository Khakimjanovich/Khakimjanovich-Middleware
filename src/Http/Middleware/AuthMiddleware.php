<?php

namespace INBRAIN\OMP\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Http;
use INBRAIN\OMP\Models\User;

class AuthMiddleware
{
    public function handle($request, Closure $next)
    {
        if ($request->bearerToken()) {
            $user = Http::withHeaders(['Authorization' => 'Bearer ' . $request->bearerToken()])->get(config('inbrain.auth_server') . '/v1/me')->json();

            if (!isset($user['id'])) {
                return response()->json(['message' => 'Auth Failed!',]);
            }
            User::firstOrCreate(['id' => $user['id']]);

            auth()->loginUsingId($user['id']);

            return $next($request);
        }

        return response()->json(['message' => 'Auth Failed!',]);
    }
}