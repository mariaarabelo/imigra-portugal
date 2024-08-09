<?php
 
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

use Illuminate\View\View;

use App\Models\User;
use App\Models\Moderator;


class LoginController extends Controller
{

    /**
     * Display a login form.
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect('/');
        } else {
            return view('auth.login');
        }
    }

    /**
     * Handle an authentication attempt.
     */
    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
    
        // Verificar o utilizador está bloqueado antes de tentar autenticar
        $user = User::where('email', $credentials['email'])->first();
        
        if ($user && $user->isblocked) {
            return back()->withErrors([
                'email' => 'Your account is blocked. Please contact support for assistance.',
            ])->onlyInput('email');
        }           
        
        if ($user && Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
 
            return redirect()->intended('/');
        }

        $moderator = Moderator::where('email', $credentials['email'])->first();

        // Attempt moderator authentication
        if ($moderator && Auth::guard('moderator')->attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }


        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Log out the user from application.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')
            ->withSuccess('You have logged out successfully!');
    } 
}
