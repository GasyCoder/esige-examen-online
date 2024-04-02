<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
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

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user();
        $userRoles = $user->roles;
        
        // Redirection selon le rôle de l'utilisateur

        foreach ($userRoles as $role) {
            switch($role->name) {   
            case 'admin':
                return redirect()->intended(route('admin.panel', absolute: false));
            break;
            case 'teacher':
                return redirect()->intended(route('teacher-panel', absolute: false));
            break;
            case 'student':
                return redirect()->intended(route('student.panel', absolute: false));
            break;
                default:
                    return redirect('/login');
            }
        }

        //return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
