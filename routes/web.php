<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
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

Route::get('/register', [AuthController::class, 'showRegister'])->name('show.register');
Route::get('/login', [AuthController::class, 'showLogin'])->name('show.login');

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ADMIN
Route::get('/admin/users', [AdminController::class, 'viewUsers'])->name('admin.users');

