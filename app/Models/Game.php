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
    ];

    protected $casts = [
        'time' => 'datetime',
    ];

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

    public static function getNextGames()
    {
        return Game::where('is_started', false)
            ->orderBy('time')
            ->take(5)
            ->with('team1', 'team2')
            ->get();
    }
}
