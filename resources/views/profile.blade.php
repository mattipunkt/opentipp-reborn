<x-layout>

    <p class="mb-4">
        <a href="/ranks" class="link-secondary link-offset-2 link-underline-opacity-25"><i class="bi bi-arrow-left"> </i> Zurück zur Tabelle</a>
    </p>

    <div class="row mb-4">
        <div class="col-3 col-md-2">
            <img src="data:image/jpg;base64,{{ $user->profile_picture }}" class="rounded-circle align-middle w-md-50 w-100" alt="Profilbild">
        </div>
        <div class="col-9">
            <h2 class="mb-1">{{ $user->name }}</h2>
            <p>
                <i>{{ $user->first_name }}</i><br>
                Punkte: <b>{{ $user->points }}</b>

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
                    <b class="d-md-none">Punkte: </b>{{ $game->points }}
                </div>
            </div>
            <hr>
            @endforeach
        </div>
    </div>


</x-layout>
