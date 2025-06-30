<x-layout>
    <p>
        <a href="/ranks" class="link-secondary link-offset-2 link-underline-opacity-25"><i class="bi bi-arrow-left"> </i> Zurück zur Tabelle</a>
    </p>

    <div class="row mb-2">
        <div class="col-3 col-md-1">
            <img src="data:image/jpg;base64,{{ $user->profile_picture }}" class="rounded-circle align-middle" alt="{{ $user->name }}">
        </div>
        <div class="col-9">
            <h2>{{ $user->name }}</h2>
            <p>
                Punkte: <b>{{ $user->points }}</b><br>
                Registriert am: <b>{{ $user->created_at->format('d.m.Y') }}</b>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h2>Letzte abgegebene Tipps</h2>
            <div class="row mb-3 d-none d-md-flex">
                <div class="col-md-2 col-12">
                    <b>Team 1</b>
                </div>
                <div class="col-md-1 col-12">
                    <b>Tipp</b>
                </div>
                <div class="col-md-2 text-md-end col-12">
                    <b>Team 2</b>
                </div>
                <div class="col-md-2 col-12">
                    <b>Punkte</b>
                </div>
            </div>
            @foreach ($games as $game)
            <div class="row mb-3 mb-md-0 text-md-start text-center">
                <div class="col-md-2 col-12">
                    {{ $game->game->team1->name }}
                </div>
                <div class="col-md-1 col-12">
                    <b>
                    {{ $game->team1_vote }} : {{ $game->team2_vote }}
                    </b>
                    <i>
                    ({{ $game->game->team1_score }} : {{ $game->game->team2_score }})
                    </i>
                </div>
                <div class="col-md-2 text-md-end col-12">
                    {{ $game->game->team2->name }}
                </div>
                <div class="col-md-2 col-12">
                    <b class="d-md-none">Punkte:</b>{{ $game->points }}
                </div>
            </div>
            <hr>
            @endforeach
        </div>
    </div>
        
        
</x-layout>
