<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function showProfile(Request $request, $username)
    {
        $user = \App\Models\User::where('name', $username)->first();
        if (! $user) {
            session()->flash('status', '❌ Benutzer nicht gefunden.');

            return redirect('/ranks');
        }

        return view('profile', [
            'user' => $user,
            'games' => \App\Models\Vote::where('user_id', $user->id)
                ->whereHas('game', function ($q) {
                    $q->where('is_finished', true);
                })
                ->get()->reverse(),
        ]);
    }
}
