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
        $id = $request->route('profile');
        if (!is_null($id) && ($id != auth()->user()->id)) {
            $response = [
                'message' => __('auth.403-errors')
            ];
            return response()->view('frontend.errors.403', $response);
        }

        $reservationId = $request->route('reservation');
        if (!is_null($reservationId)) {
            $reservationIds = auth()->user()->reservations()->pluck('id')->toarray();
            if (!in_array($reservationId, $reservationIds)) {
                $response = [
                    'message' => __('auth.403-errors')
                ];
                return response()->view('frontend.errors.403', $response);
            }
        }
        
        return $next($request);
    }
}
