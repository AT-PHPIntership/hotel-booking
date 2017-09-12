<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUser
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request of user
     * @param \Closure                 $next    request
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $id = $request->route('id');
        if (!is_null($id) && ($id != auth()->user()->id)) {
            $response = [
                'message' => 'Forbidden'
            ];
            return response()->view('frontend.errors.403', $response);
        }
        return $next($request);
    }
}
