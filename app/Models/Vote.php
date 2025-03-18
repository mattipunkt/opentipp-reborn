<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    //
    protected $fillable = [
        'user',
        'game',
        'team1_vote',
        'team2_vote',
        'points'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
