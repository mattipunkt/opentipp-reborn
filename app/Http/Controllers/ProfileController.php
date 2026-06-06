<?php

namespace App\Http\Controllers;

use App\Models\Game;
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
            'showWinner' => Game::getNextGames()->first()->is_started,
            'user' => $user,
            'games' => \App\Models\Vote::where('user_id', $user->id)
                ->whereHas('game', function ($q) {
                    $q->where('is_finished', true);
                })
                ->get()->reverse(),
        ]);
    }

    public function saveProfileSettings(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'string|max:255',
            'name' => 'string|max:255',
            'location' => 'max:255',
            'slogan' => 'max:255',
        ]);

        $user = $request->user();
        $user->location = $validated['location'];
        $user->slogan = $validated['slogan'];
        $user->first_name = $validated['first_name'];
        $user->name = $validated['name'];
        $user->save();
        return redirect()->back()->with('status', 'Einstellungen erfolgreich gespeichert.');
    }
}
