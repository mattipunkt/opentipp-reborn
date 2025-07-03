<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate(
            [
                'name' => 'required|string|max:255',
                'first_name' => 'required|string|max:255',
                'email' => 'required|email|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ]
        );

        $firstUser = User::count() === 0;
        $user = User::create($validated);

        if ($firstUser) {
            $user->is_admin = true;
            $user->is_accepted = true;
            $user->save();
            Auth::login($user);
        } else {
            $user->is_accepted = false;
            $user->save();
            session()->flash('status', '🚀 Registrierung erfolgreich! Der Account muss jedoch noch manuell vom Admin aktiviert werden. Wenn es soweit ist, erhältst du eine E-Mail!');
        }

        return redirect('/');
    }

    public function login(Request $request)
    {
        $validated = $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required|string',
            ]
        );
        $user = User::where('email', $validated['email'])->first();

        if ($user && ! $user->is_accepted) {
            session()->flash('status', '🚀 Dein Account wurde noch nicht freigeschaltet! Bitte warte, bis du eine E-Mail bekommst!');

            return redirect('/');
        }

        if (Auth::attempt($validated)) {
            $request->session()->regenerate();

            return redirect('/');
        }

        throw ValidationException::withMessages([
            'credentials' => '🫣 Falsche Zugangsdaten!',
        ]
        );
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
