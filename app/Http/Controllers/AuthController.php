<?php

namespace App\Http\Controllers;

use App\Models\Pewawancara;
use App\Models\UserGuru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLogin(): \Illuminate\View\View
    {
        return view('auth.login');
    }

    /**
     * Handle an authentication attempt.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (!Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()->withErrors([
                'username' => 'Kredensial tidak valid.',
            ])->onlyInput('username');
        }

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard'));
    }

    /**
     * Show a simple dashboard page.
     */
    public function dashboard(): \Illuminate\View\View
    {
        $user = auth()->user();

        if ($user->role === 'penilai') {
            $evaluatedIds = \App\Models\HasilPenilaian::where('statusnilai', 1)->pluck('user_guru_id');
            $guruList = UserGuru::whereNotIn('id', $evaluatedIds)->orderBy('nama')->get();
            $timOrder = ['Tim A', 'Tim B', 'Tim C', 'Tim D'];
            $pewawancaraGroups = Pewawancara::orderBy('nama')
                ->get()
                ->sortBy(function ($p) use ($timOrder) {
                    return array_search($p->tim, $timOrder);
                })
                ->groupBy('tim');

            return view('penilai.dashboard', [
                'guruList' => $guruList,
                'pewawancaraGroups' => $pewawancaraGroups,
            ]);
        }

        return view('dashboard');
    }

    /**
     * Log the user out and destroy the session.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
