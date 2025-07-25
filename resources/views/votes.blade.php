<x-layout>
    @php
        $tabIndex = 1;
    @endphp
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
        <!-- Mobile View -->
            <div class="col-5 d-md-none mt-1 mb-1 text-end">
                <span>{{ $vote->game->team1->name }}</span>
            </div>
            <div class="col-1 d-md-none text-center">
                <span>{{ $vote->game->team1->icon_url }}</span>
            </div>
            <div class="col-1 d-md-none text-center">
                <span>{{ $vote->game->team2->icon_url }}</span>
            </div>
            <div class="col-5 d-md-none text-start">
                <span>{{ $vote->game->team2->name }}</span>
            </div>

        <!-- End Mobile View -->

        <!-- Team 1 Name -->
        <div class="d-md-block d-none col-md-2 mb-1 mb-md-0">
            <span class="d-block text-truncate">{{ $vote->game->team1->name }}</span>
        </div>
        <div class="d-md-block d-none col-1">
            <span>{{ $vote->game->team1->icon_url }}</span>
        </div>
        <!-- Punkt-Eingabe -->
        <div class="col-12 col-md-2 mb-1 mb-md-0">
            <div class="d-flex justify-content-center justify-content-md-start align-items-center gap-2">
                <input type="hidden" name="votes[{{ $vote->game->id }}][game_id]" value="{{ $vote->game->id }}">
                <input tabindex="{{ $tabIndex++ }}" type="number" class="form-control text-center px-1" pattern="[0-9]*" maxlength="2" style="width: 50px;" name="votes[{{ $vote->game->id }}][team1_score]" value="{{ $vote->team1_vote }}" @if($vote->game->time->isPast()) disabled @endif>
                <span>:</span>
                <input tabindex="{{ $tabIndex++ }}" type="number" class="form-control text-center px-1" pattern="[0-9]*" maxlength="2" style="width: 50px;" name="votes[{{ $vote->game->id }}][team2_score]" value="{{ $vote->team2_vote }}" @if($vote->game->time->isPast()) disabled @endif>
            </div>
        </div>

        <!-- Team 2 Name -->
        <div class="d-md-block d-none col-1">
            <span>{{ $vote->game->team2->icon_url }}</span>
        </div>
        <div class="d-md-block d-none col-12 col-md-1 text-md-end">
            <span class="d-block text-truncate"> {{ $vote->game->team2->name }}</span>
        </div>
        @if($vote->game->is_finished)
            <div class="col-12 col-md-2 text-md-center">
                <i>({{ $vote->game->team1_score }} : {{ $vote->game->team2_score }})</i>
            </div>
        @endif



    </div>
    @endforeach
    <div class="text-center text-md-start mb-3">
        <button type="submit" class="btn btn-info w-auto">
            Speichern
        </button>
    </div>
    </form>
</x-layout>
