<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\AuthenticateWithAccessTokenTrait;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class AuthenticatedSessionController extends Controller
{
    use AuthenticateWithAccessTokenTrait;

    /**
     * Display the login view.
     */
    public function create(Request $request)
    {
        if ($this->authWithAccessToken($request)) {
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        return view('auth.login');
    }

    public function createURGLogin(Request $request)
    {
        if ($this->authWithAccessToken($request)) {
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        return view('auth.urg-login');
    }    

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        if ($request->user()) {
            $request->user()->update([
                'last_login' => Carbon::now()->toDateTimeString(),
            ]);
        }

        if ($request->has('url')) {
            if ($request->get('url') === 'oportunidades_negocio') {
                $queryParams = request()->query();
                unset($queryParams['url']);
                $queryString = count($queryParams) > 0 ? '?' . http_build_query($queryParams) : '';
                $opnRoute = route('oportunidades-negocio.search') . $queryString . '#seccion-principal';

                return redirect()->intended($opnRoute);
            }
            
            return redirect()->intended($request->get('url'));
        }

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroyCurrent(Request $request)
    {
        if (Auth::user()) {
            Auth::guard('web')->logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return response()->json(true);
        }

        return response()->json(true);
    }
}
