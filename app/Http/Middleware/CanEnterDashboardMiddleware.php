<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CanEnterDashboardMiddleware
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
        $roleName = $user->role->name ;
        if ($roleName == 'Superadmin' or $roleName == 'Admin') {
            return $next($request);
        }
        return  response()->json([
            'Message' => 'Sorry , You Must be Adminstrator'
        ]);
    }
}
