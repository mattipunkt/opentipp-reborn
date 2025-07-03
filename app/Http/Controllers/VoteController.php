<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\GameType;
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
        $votes = Vote::whereHas('game', function ($query) use ($gametype_id) {
            $query->whereHas('gameType', function ($query) use ($gametype_id) {
                $query->where('id', $gametype_id);
            });
        })->where('user_id', auth()->id())
            ->with('game.team1', 'game.team2') // Hier laden Sie die Beziehung game und dessen Beziehungen team1 und team2
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
}
