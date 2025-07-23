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

function refreshGameData()
{
    $url = 'https://api.openligadb.de/getmatchdata/Fef/2025';
    $obj = json_decode(file_get_contents($url), true);
    foreach ($obj as $match) {
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
})->everyTenMinutes();

function calcPoints(): void
{
    $votes = Vote::all();

    foreach ($votes as $vote) {
        if ($vote->game->is_finished) {
            $points = 0;
            $game = $vote->game;
            if (! isset($vote->team1_vote) || ! isset($vote->team2_vote)) {
                $vote->points = $points;
                $vote->save();

                continue;
            } else {
                if ($game->team1_score == $game->team2_score) {
                    $data_winner = 0;
                } elseif ($game->team1_score > $game->team2_score) {
                    $data_winner = 1;
                } elseif ($game->team1_score < $game->team2_score) {
                    $data_winner = 2;
                }
                if ($vote->team1_vote == $vote->team2_vote) {
                    $voter_winner = 0;
                } elseif ($vote->team1_vote > $vote->team2_vote) {
                    $voter_winner = 1;
                } elseif ($vote->team1_vote < $vote->team2_vote) {
                    $voter_winner = 2;
                }
                if ($voter_winner === $data_winner) {
                    $points = 1;
                    $data_differenz = $game->team1_score - $game->team2_score;
                    $voter_differenz = $vote->team1_vote - $vote->team2_vote;
                    if ($data_differenz == $voter_differenz) {
                        $points = 3;
                    }
                    if ($vote->team1_vote == $game->team1_score && $vote->team2_vote == $game->team2_score) {
                        $points = 5;
                    }
                }
            }
            $vote->points = $points;
            $vote->save();
        }

    }

    $users = User::all();
    foreach ($users as $user) {
        $votes = Vote::where('user_id', $user->id)->get();
        $points = 0;
        foreach ($votes as $vote) {
            $points += $vote->points;
        }
        $user->points = $points;
        $user->save();
    }
}

Schedule::call(function () {
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
})->hourly();

Schedule::call(function () {
    calcPoints();
})->everyTenMinutes();

Artisan::command('calc:votes', function () {
    calcPoints();
});
