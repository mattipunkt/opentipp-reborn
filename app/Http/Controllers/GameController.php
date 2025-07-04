<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Vote;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function showMatch(int $id, Request $request) {
        return view('game', [
            'game' => Game::where('id', $id)->first(),
            'votes' => Vote::where('game_id', $id)->get(),
        ]);
    }
}
