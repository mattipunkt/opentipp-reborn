<x-layout>
    <span>{{ $game->time->format('d.m.Y,  H:i') }}</span>
    <h1> {{ $game->team1->name }} : {{ $game->team2->name }}
        <i><small>({{ $game->team1_score }} : {{ $game->team2_score }})</small></i>
    </h1>
    <h4>Informationen</h4>
    <p>folgen bald...</p>
    <h4>Tips der Nutzer:innen</h4>
    @if($game->time->isPast())
    <div class="row mb-3">
        <div class="col-12 col-md-3 d-hidden d-md-flex">
            <b>Nutzername</b>
        </div>
        <div class="col-12 col-md-1">
            <b>{{ $game->team1->name }}</b>
        </div>
        <div class="col-12 col-md-1">
            <span></span>
        </div>
        <div class="col-12 col-md-2">
            <b>{{ $game->team2->name }}</b>
        </div>

        <div class="col-12 col-md-2">
            <b>Punkte</b>
        </div>
    </div>
        @foreach($votes as $vote)
            <div class="row">
                <div class="col-12 col-md-3">
                    <a class="link-body-emphasis link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover" href="/user/{{ $vote->user->name }}">
                        <b>{{ $vote->user->name }}</b> <i>({{$vote->user->first_name}})</i>
                    </a>
                </div>
                <div class="col-12 col-md-1 text-align-center">
                    @if($vote->team1_vote !== null) {{ $vote->team1_vote }} @else - @endif
                </div>
                <div class="col-12 col-md-1">
                    <span> : </span>
                </div>
                <div class="col-12 col-md-2">
                    @if($vote->team1_vote !== null) {{ $vote->team2_vote }} @else - @endif
                </div>
                <div class="col-12 col-md-2">
                    {{ $vote->points }}
                </div>
            </div>
        @endforeach
    @else
        <i>Du kannst die Tipps deiner Mitspieler:innen erst sehen, wenn das Spiel angefangen hat.</i>
    @endif
</x-layout>
