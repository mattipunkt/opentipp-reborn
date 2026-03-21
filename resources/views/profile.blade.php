<x-layout>
    <div class="card card-border shadow bg-base-200">
        <div class="card-body">
            <div class="flex flex-col md:flex-row gap-4 md:items-center">
                <div class="flex justify-center">
                    <img src="data:image/jpg;base64,{{ $user->profile_picture }}" class="rounded-full border-2 shadow-lg align-middle md:w-50 w-50" alt="Profilbild">
                </div>
                <div class="">
                    <h2 class="font-bold text-xl">{{ $user->name }}</h2>
                    <p>
                        <i>{{ $user->first_name }}</i><br>
                        Punkte: <b>{{ $user->points }}</b>

                    </p>
                </div>
            </div>
            <div class="mt-2">
                <h3 class="text-2xl font-medium">
                    Letzte Tipps
                </h3>
                <div class="grid md:grid-cols-4 gap-3 grid-cols-2">

                @foreach ($games as $game)
                    <div class="card card-border shadow">
                        <div class="card-body">


                    <a class="link-body-emphasis link-underline link-underline-opacity-0" href="/match/{{ $game->id }}"}}>
                        <div class="row mb-3 mb-md-0 text-md-start text-center">
                            <span class="italic mb-1 font-medium underline">
                                {{ $game->game->time->format('d.m.Y, H:i') }}
                            </span>
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
                            <div class="mt-1">
                                @if($game->team1_vote)
                                    <b class="d-md-none">Punkte: </b>
                                    {{ $game->points }}
                                @else
                                    <b> <i>Kein Tipp abgegeben</i></b><br>
                                    <i class="">(Punkte: 0)</i>
                                @endif
                            </div>
                        </div>
                    </a>
                    </div>
                    </div>
                @endforeach
                </div>

            </div>
        </div>
    </div>

</x-layout>
