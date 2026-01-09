<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAuth
{
    public function handle(Request $request, Closure $next)
    {
        // Simple auth (ganti dengan sistem login real nanti)
        $adminPassword = '@Berkah01'; // Ubah ini!
        
        if ($request->session()->get('admin_logged_in') !== true) {
            if ($request->input('admin_pass') === $adminPassword) {
                $request->session()->put('admin_logged_in', true);
            } else {
                return response('Unauthorized', 401);
            }
        }
        
        return $next($request);
    }
}