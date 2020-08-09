<?php

namespace App\Http\Middleware;

use App\Helpers\CommonHelper;
use Closure;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!CommonHelper::checkAdmin()) {
            return redirect('/');
        }
        return $next($request);
    }
}
