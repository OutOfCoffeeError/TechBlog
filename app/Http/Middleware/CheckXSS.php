<?php

namespace App\Http\Middleware;

use App\Helpers\CommonHelper;
use Closure;

class CheckXSS
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
        $inputArr = $request->all();
        foreach ($inputArr as $input) {
            error_log($request->url());
            if(gettype($input) == 'string') {
                if(CommonHelper::checkXSS($input)) {
                    return redirect()->back()->with('error', 'Invalid Content');
                }
            }
        }
        return $next($request);
    }
}
