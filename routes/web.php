<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VoteController;
use App\Http\Controllers\ProfilePictureController;


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use App\Models\Game;
use App\Models\Team;
use App\Models\GameType;
use App\Models\User;
use App\Models\Vote;

$proxy_url    = getenv('PROXY_URL');

if (!empty($proxy_url)) {
   URL::forceRootUrl($proxy_url);
}


Route::get('/', function () {
    # dd(Game::getNextGames());
    return view('home', [
        'nextGames' => Game::getNextGames(),
    ]);
});


Route::get('/register', [AuthController::class, 'showRegister'])->name('show.register');
Route::get('/login', [AuthController::class, 'showLogin'])->name('show.login');

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ADMIN
Route::get('/admin/users', [AdminController::class, 'viewUsers'])->name('admin.users');

// Votes
Route::get('/vote', [VoteController::class, 'viewVotes'])->name('vote');
Route::post('/vote', [VoteController::class, 'storeVotes'])->name('store.votes');


// Ranking-Tabelle
Route::get('/ranks', function () {
    return view('ranks', [
        'users' => User::orderBy('points', 'desc')->get(),
    ]);
});

//Profilbild
Route::get('/profilepicture', [ProfilePictureController::class, 'viewProfilePictureChanger'])->name('show.profilepicture');
Route::post('/profilepicture', [ProfilePictureController::class, 'saveProfilePicture'])->name('save.profilepicture');