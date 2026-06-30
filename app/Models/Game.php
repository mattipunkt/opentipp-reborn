<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
        'team1_id',
        'team2_id',
        'team1_score',
        'team2_score',
        'is_finished',
        'time',
        'is_started',
        'game_type',
        'openligadb_id',
        'manually_edited'
    ];

    protected $casts = [
        'time' => 'datetime',
    ];

    public static function getLastGames()
    {
        return Game::where('is_finished', true)->orderBy('time', 'desc')->take(5)->get();
    }

    public function team1()
    {
        return $this->hasOne(Team::class, 'id', 'team1_id');
    }

    public function team2()
    {
        return $this->hasOne(Team::class, 'id', 'team2_id');
    }

    public function gameType()
    {
        return $this->hasOne(GameType::class, 'id', 'game_type');
    }

    public function vote($user_id, $game_id): bool
    {
        return Vote::where('user_id', $user_id)->where('game_id', $game_id)->first()->team1_vote !== null;

    }

    public static function getNextGames()
    {
        return Game::where('is_started', false)
            ->orderBy('time')
            ->take(5)
            ->with('team1', 'team2')
            ->get();
    }
}
