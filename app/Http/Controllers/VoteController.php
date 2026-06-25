<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\GameType;
use App\Models\Team;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function viewVotes(Request $request)
    {
        if (! auth()->check()) {
            session()->flash('status', '❌ Du hast vergessen dich anzumelden... (hoffentlich)');

            return redirect('/login');
        }

        if ($request->query('gt')) {
            $gametype_id = $request->query('gt');
        } else {
            $nextGame = Game::getNextGames()->first();
            if ($nextGame == null) {
                $nextGame = Game::all()->last();
                session()->flash('status', '🫨 Dieses Turnier ist beendet. Du kannst also nicht mehr abstimmen!');
            }
            $gametype_id = $nextGame->gameType->id;
        }
        $votes = Vote::join('games', 'votes.game_id', '=', 'games.id')
            ->whereHas('game', function ($query) use ($gametype_id) {
                $query->whereHas('gameType', function ($query) use ($gametype_id) {
                    $query->where('id', $gametype_id);
                });
            })
            ->where('votes.user_id', auth()->id()) // Eindeutig machen wegen des Joins
            ->with('game.team1', 'game.team2')
            ->orderBy('games.time', 'asc') // 'time' statt 'start_time'
            ->select('votes.*') // Verhindert das Überschreiben der Vote-IDs
            ->get();

        return view('votes', [
            'gametypes' => GameType::all(),
            'gtid' => $gametype_id,
            'votes' => $votes,
        ]);
    }

    public function storeVotes(Request $request)
    {
        $votes = $request->input('votes');
        foreach ($votes as $vote) {
            if (! isset($vote['team1_score'], $vote['team2_score'])) {
                continue; // Felder fehlen, z.B. weil das Spiel schon gestartet ist
            }
            $gameId = $vote['game_id'];
            $team1Score = $vote['team1_score'];
            $team2Score = $vote['team2_score'];

            $voteInstance = Vote::where('game_id', $gameId)->where('user_id', auth()->id())->first();
            if (! $voteInstance) {
                $voteInstance = new Vote;
                $voteInstance->game_id = $gameId;
                $voteInstance->user_id = auth()->id();
            }

            // Hier speicherst du die Votes in der Datenbank
            $voteInstance->team1_vote = $team1Score;
            $voteInstance->team2_vote = $team2Score;
            $voteInstance->save();
        }

        return redirect()->back()->with('success', 'Votes erfolgreich gespeichert!');
    }

    public function viewSpecialVotesSite(Request $request) {

        if (! auth()->check()) {
            session()->flash('status', '❌ Du hast vergessen dich anzumelden... (hoffentlich)');

            return redirect('/login');
        }
        $allowedToChange = Game::all()->first()->is_started;
        return view('special_vote', [
            'teams' => Team::all()->sortBy('name'),
            'allowedToChange' => $allowedToChange,
            'user' => auth()->user(),
        ]);
    }

    public function saveSpeicalVote(Request $request)
    { // Validiere die Eingabe
        $validated = $request->validate([
            'team_id' => 'nullable|exists:teams,id', // Prüft, ob team_id existiert
        ]);

        $user = auth()->user();

        // Speichere die Auswahl
        $user->team_id = $validated['team_id'];
        $user->save();

        return redirect()->back()->with('success', 'Vote erfolgreich gespeichert!');
    }

    public static function calcPoints(bool $matchFinished = false): void
    {
        $null_votes = Vote::whereNull('game_id')->get();
        foreach ($null_votes as $vote) {
            $vote->delete();
        }

        $votes = Vote::all();


        foreach ($votes as $vote) {
            if (optional($vote->game)->is_finished) {
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
                            $points = 2;
                        }
                        if ($vote->team1_vote == $game->team1_score && $vote->team2_vote == $game->team2_score) {
                            $points = 3;
                        }
                    }
                }
                $vote->points = $points;
                $vote->save();
            }

        }

        $lastGame = Game::orderBy('time', 'desc')->first();
        $lastGameWinner = $lastGame->team1_score > $lastGame->team2_score ? $lastGame->team1 : $lastGame->team2;

        $users = User::all();
        foreach ($users as $user) {
            $votes = Vote::where('user_id', $user->id)->get();

            $points = 0;
            foreach ($votes as $vote) {
                $points += $vote->points;
            }
            if ($matchFinished && $user->team_id == $lastGameWinner->id) {
                $points = $points + 10;
            }
            $user->points = $points;
            $user->save();
        }
    }
}
