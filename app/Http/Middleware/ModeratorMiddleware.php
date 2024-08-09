<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Http\Request;


class ModeratorMiddleware {
    public function handle(Request $request, Closure $next){
        if(Auth::guard('moderator')->check()) {
            return $next($request);
        }
        return redirect('/');
    }
}
