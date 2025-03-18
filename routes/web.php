<?php

use Illuminate\Support\Facades\Route;
use App\Models\Game;
use App\Models\Team;
use App\Models\GameType;

Route::get('/', function () {
 
    # dd(Game::getNextGames());
    return view('home', [
        'nextGames' => Game::getNextGames(),
    ]);
});

