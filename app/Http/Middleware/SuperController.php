<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SuperController
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $roleId = Role::select('id','name')->where('name' , 'Superadmin')->first()->id;
        if (Auth::user()->role_id == $roleId ) {
            return $next($request);
        }
        return response()->json([
            'Message' => 'Sorry ,Super Admin only can access'
        ]);
    }
}
