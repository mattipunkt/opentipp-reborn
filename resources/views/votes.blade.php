<x-layout>

    <h1>
        Tippen!
    </h1>
    <p>
        Hier kannst du deine Tipps abgeben. Vergiss nicht, vor Spielbeginn zu tippen und deine Tipps zu speichern!
    </p>
    <ul class="nav nav-underline nav-underline-info d-md-inline-flex d-none mb-3">
        @foreach($gametypes as $gt)
        <li class="nav-item">
          <a class="nav-link @if($gt->id == $gtid) active @endif" aria-current="page" href="vote?gt={{ $gt->id }}">{{ $gt->name }}</a>
        </li>
        @endforeach
    </ul>
    
    <div class="dropdown d-md-none">
        
        <a class="btn btn-outline-info mx-auto dropdown-toggle w-100" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        @foreach($gametypes as $gt) 
            @if($gt->id == $gtid) {{ $gt->name }} @endif
        @endforeach
        </a>

        <ul class="dropdown-menu w-100">
        @foreach($gametypes as $gt) 
            <li><a class="dropdown-item" href="vote?gt={{ $gt->id }}">{{ $gt->name }}</a></li>
        @endforeach
        </ul>
    </div>



    <br>
    <form method="post" action="/vote?gt={{ $gtid }}">
    @csrf
    @foreach($votes as $vote)
    <div class="row mb-4 mb-md-2 align-items-center text-center text-md-start">
        <div class="col-12 col-md-2">
            <span class="d-block text-truncate"><b>{{ $vote->game->time->format('d.m.Y, H:i') }}</b></span>
        </div>
        <!-- Team 1 Name -->
        <div class="col-12 col-md-2 mb-1 mb-md-0">
            <span class="d-block text-truncate">{{ $vote->game->team1->name }}</span>
        </div>

        <!-- Punkt-Eingabe -->
        <div class="col-12 col-md-1 mb-1 mb-md-0">
            <div class="d-flex justify-content-center justify-content-md-start align-items-center gap-2">
                <input type="hidden" name="votes[{{ $vote->game->id }}][game_id]" value="{{ $vote->game->id }}">
                <input class="form-control text-center px-1" maxlength="2" style="width: 50px;" name="votes[{{ $vote->game->id }}][team1_score]" value="{{ $vote->team1_vote }}" @if($vote->game->time->isPast()) disabled @endif>
                <span>:</span>
                <input class="form-control text-center px-1" maxlength="2" style="width: 50px;" name="votes[{{ $vote->game->id }}][team2_score]" value="{{ $vote->team2_vote }}" @if($vote->game->time->isPast()) disabled @endif>
            </div>
        </div>

        <!-- Team 2 Name -->
        <div class="col-12 col-md-2 text-md-end">
            <span class="d-block text-truncate">{{ $vote->game->team2->name }}</span>
        </div>


    </div>
    @endforeach
    <div class="text-center text-md-start mb-3">
        <button type="submit" class="btn btn-info w-auto">
            Speichern
        </button>
    </div>
    </form>
</x-layout>