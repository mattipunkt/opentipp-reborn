<x-layout>
    <h1>
        Tippen!
    </h1>
    <ul class="nav nav-pills nav-justified">
        @foreach($gametypes as $gt)
        <li class="nav-item">
          <a class="nav-link @if($gt->id == $gtid) active @endif" aria-current="page" href="vote?gt={{ $gt->id }}">{{ $gt->name }}</a>
        </li>
        @endforeach

    </ul>

    <br>
    <form method="post" action="/vote?gt={{ $gtid }}">
    @csrf
    @foreach($votes as $vote)
    <div class="row mb-4 mb-md-2 align-items-center text-center text-md-start">
        <!-- Team 1 Name -->
        <div class="col-12 col-md-2 mb-1 mb-md-0">
            <span class="d-block text-truncate">{{ $vote->game->team1->name }}</span>
        </div>

        <!-- Punkt-Eingabe -->
        <div class="col-12 col-md-2 mb-1 mb-md-0">
            <div class="d-flex justify-content-center justify-content-md-start align-items-center gap-2">
                <input type="hidden" name="votes[{{ $vote->game->id }}][game_id]" value="{{ $vote->game->id }}">
                <input class="form-control text-center px-1" maxlength="2" style="width: 50px;" name="votes[{{ $vote->game->id }}][team1_score]" value="{{ $vote->team1_vote }}" @if($vote->game->is_started) disabled @endif>
                <span>:</span>
                <input class="form-control text-center px-1" maxlength="2" style="width: 50px;" name="votes[{{ $vote->game->id }}][team2_score]" value="{{ $vote->team2_vote }}" @if($vote->game->is_started) disabled @endif>
            </div>
        </div>

        <!-- Team 2 Name -->
        <div class="col-12 col-md-1" style="padding-left: 8px;">
            <span class="d-block text-truncate">{{ $vote->game->team2->name }}</span>
        </div>

    </div>
    @endforeach
    <div class="text-center text-md-start mb-3">
        <button type="submit" class="btn btn-info">
            Speichern
        </button>
    </div>
    </form>
</x-layout>