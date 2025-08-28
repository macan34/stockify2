<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    protected function authenticated(Request $request, $user)
{
    $roleName = $user->role->name; // Ambil nama role dari relasi

    if($roleName == 'admin'){
        return redirect()->route('admin.dashboard');
    } elseif($roleName == 'manager'){
        return redirect()->route('manager.dashboard');
    } elseif($roleName == 'staff'){
        return redirect()->route('staff.dashboard');
    } else {
        return redirect('/'); // default fallback
    }
}

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
{
    $request->authenticate();
    $request->session()->regenerate();

    // panggil method authenticated() untuk redirect sesuai role
    return $this->authenticated($request, $request->user());
}
    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
