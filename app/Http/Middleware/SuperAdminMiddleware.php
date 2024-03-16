<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SuperAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userEmail = $request->email;
        $user = User::where('email' , $userEmail)->first();
        if ($user->role->name == 'Superadmin') {
            return $next($request);
        }
        return response()->json([
            'Message' => 'Sorry ,Super Admin only can access'
        ]);
    }
}
