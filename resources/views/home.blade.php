<x-layout>
    <h1>
        Startseite
    </h1>
    <div class="card">
        <div class="card-body">
            <h4>
                Nächste Spiele
            </h4>
                @foreach ($nextGames as $game)
                    <div>
                        <div class="text-center fw-bold">
                            {{ $game->time->format('d.m.Y,  H:i') }} Uhr
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="">
                                {{ $game->team1->name }} 
                            </div>
                            <span> -   </span>
                            <div class="">
                                 {{ $game->team2->name }}
                            </div>
                        </div>
                    </div>
                    <br>
                @endforeach
            
        </div>
    </div>
</x-layout>