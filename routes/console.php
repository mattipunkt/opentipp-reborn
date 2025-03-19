<?php

use Illuminate\Foundation\Console\ClosureCommand;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Models\Game;
use App\Models\Team;
use App\Models\GameType;

Artisan::command('inspire', function () {
    /** @var ClosureCommand $this */
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


Schedule::call(function () {
    $url = 'https://api.openligadb.de/getmatchdata/bl2/2024';
    $obj = json_decode(file_get_contents($url), true);
    foreach ($obj as $match) {
        $game = Game::firstOrCreate(
            [
                "team1_id" => Team::firstOrCreate(["name" => $match["team1"]["teamName"]])["id"],
                "team2_id" => Team::firstOrCreate(["name" => $match["team2"]["teamName"]])["id"],
                "time" =>  DateTime::createFromFormat('Y-m-d\TH:i:s', $match["matchDateTime"]),
                "game_type" => GameType::firstOrCreate(["name" => $match["group"]["groupName"]])["id"]
            ]
        );
        if ($match["matchIsFinished"] == true) {
            $team1_score = end($match["matchResults"])["pointsTeam1"];
            $team2_score = end($match["matchResults"])["pointsTeam2"];
            $game->update([
                "team1_score" => $team1_score,
                "team2_score" => $team2_score,
                "is_finished" => true,
                "is_started" => true
            ]);
        } 
        if (DateTime::createFromFormat('Y-m-d\TH:i:s', $match["matchDateTime"]) < now()) {
            $game->update([
                "is_started" => true
            ]);
        }
    }
})->everyFifteenSeconds()->sendOutputTo('/home/matti/Dokumente/logs.txt');
