<?php

namespace App\Http\Controllers\Auth\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginAdminRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.admin.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginAdminRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginAdminRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('admin.dashboard'))
            ->withCookie('access_token',auth('admin')->user()->createToken('website')->plainTextToken);
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('admin')->user()->tokens()->delete();;
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/')->withCookie(Cookie::forget('access_token'));
    }
}
