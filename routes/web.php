<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfilePictureController;
use App\Http\Controllers\VoteController;
use App\Models\Game;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

$proxy_url = getenv('PROXY_URL');

if (! empty($proxy_url)) {
    URL::forceRootUrl($proxy_url);
}

Route::get('/', function () {
    // dd(Game::getNextGames());
    return view('home', [
        'nextGames' => Game::getNextGames(),
        'lastGames' => Game::getLastGames(),
        'users' => User::orderBy('points', 'desc')->get(),
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

// User
Route::get('/user/{username}', [ProfileController::class, 'showProfile'])->name('show.profile');

// Profilbild
Route::get('/profilepicture', [ProfilePictureController::class, 'viewProfilePictureChanger'])->name('show.profilepicture');
Route::post('/profilepicture', [ProfilePictureController::class, 'saveProfilePicture'])->name('save.profilepicture');

// Games
Route::get('/match/{id}', [\App\Http\Controllers\GameController::class, 'showMatch'])->name('show.match');
