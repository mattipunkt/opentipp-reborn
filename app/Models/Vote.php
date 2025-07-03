<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    //
    protected $fillable = [
        'user_id',
        'game_id',
        'team1_vote',
        'team2_vote',
        'points',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function game()
    {
        return $this->hasOne(Game::class, 'id', 'game_id');
    }
}
