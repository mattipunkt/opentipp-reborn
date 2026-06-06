<?php

use App\Models\Game;
use App\Models\GameType;
use App\Models\Team;
use App\Models\User;
use App\Models\Vote;
use App\Providers\CountryProvider;
use Illuminate\Foundation\Console\ClosureCommand;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

function create_votes_for_all_users(): void {
    $users = User::all();
    foreach ($users as $user) {
        $games = Game::all();
        foreach ($games as $game) {
            Vote::firstOrCreate([
                'user_id' => $user->id,
                'game_id' => $game->id,
            ]);
        }
    }
}

function refreshGameData()
{
    $url = 'https://api.openligadb.de/getmatchdata/wm26/2026';
    $obj = json_decode(file_get_contents($url), true);
    foreach ($obj as $match) {
        echo 'running.';
        $game = Game::firstOrCreate(
            [
                'openligadb_id' => $match['matchID'],
            ]
        );
        $game->update(
            [
                'team1_id' => Team::firstOrCreate(['name' => $match['team1']['teamName']])['id'],
                'team2_id' => Team::firstOrCreate(['name' => $match['team2']['teamName']])['id'],
                'time' => DateTime::createFromFormat('Y-m-d\TH:i:s', $match['matchDateTime']),
                'game_type' => GameType::firstOrCreate(['name' => $match['group']['groupName']])['id'],
            ]
        );
        if ($match['matchIsFinished']) {
            $team1_score = end($match['matchResults'])['pointsTeam1'];
            $team2_score = end($match['matchResults'])['pointsTeam2'];
            $game->update([
                'team1_score' => $team1_score,
                'team2_score' => $team2_score,
                'is_finished' => true,
                'is_started' => true,
            ]);
        }
        if (DateTime::createFromFormat('Y-m-d\TH:i:s', $match['matchDateTime']) < now()) {
            $game->update([
                'is_started' => true,
            ]);
        }
    }
    foreach (Team::all() as $team) {
        $team->icon_url = CountryProvider::mapStringToCountryEmoji($team->name);
        $team->save();
    }
    $file = fopen('/tmp/opentipp_last_update', 'w');
    echo fwrite($file, time());
    fclose($file);
}

Artisan::command('inspire', function () {
    /** @var ClosureCommand $this */
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('oldb', function () {
    refreshGameData();
});

// Debug function for testing the point-counting function
Artisan::command('dbug:votes', function () {
    $votes = Vote::all();
    foreach ($votes as $vote) {
        $game = $vote->game;
        $vote->team1_vote = $game->team1_score;
        $vote->team2_vote = $game->team2_score;
        $vote->save();
    }
});

Schedule::call(function () {
    refreshGameData();
    create_votes_for_all_users();
    \App\Http\Controllers\VoteController::calcPoints();
})->everyTenMinutes();


Artisan::command('calc:votes', function () {
    \App\Http\Controllers\VoteController::calcPoints();
});

Artisan::command('create:votes', function () {
    create_votes_for_all_users();
});
