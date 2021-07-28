<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class Employee
{
    /**
     * Handle an incoming request.
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check()) {
            if ($request->ajax()) {
                return response()->json(['status' => Response::$statusTexts[Response::HTTP_UNAUTHORIZED]])
                    ->setStatusCode(Response::HTTP_UNAUTHORIZED);
            }
            return redirect()->route('login');
        }

        if (Auth::user()->role != Config::get('constants.roles.2')) {
            return redirect()->to(RouteServiceProvider::HOME);
        }

        return $next($request);
    }
}
