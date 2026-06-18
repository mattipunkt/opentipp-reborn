<x-layout>
<div class="grid gap-2">
    <div class="card card-border shadow bg-base-200">
        <div class="card-body">
            <div class="grid justify-center gap-2">
                <span class="text-center text-lg">{{ $game->time->format('d.m.Y,  H:i') }} Uhr</span>
                <div class="grid grid-cols-5 text-3xl font-bold">
                    <div class="col-span-2 text-right break-words">
                        {{ $game->team1->name }}
                    </div>
                    <div class="col-span-1 text-center font-light">
                        @if($game->is_finished)
                            {{ $game->team1_score }} : {{ $game->team2_score }}
                        @else
                            :
                        @endif
                    </div>
                    <div class="col-span-2 text-left break-words">
                        {{ $game->team2->name }}
                    </div>
                </div>
    </div>
</div>
    </div>
    <div class="card card-border shadow bg-base-200">
    <div class="card-body">
        <h3 class="text-xl font-bold">Tipps der Mitspieler:innen</h3>
        @if($game->is_started)
            <div class="grid md:grid-cols-4 grid-cols-1 gap-4">
                @foreach($votes as $vote)
                    <div class="card card-border shadow">
                        <div class="card-body">
                            <div class="grid grid-cols-1  justify-items-center">
                                <img class="w-20 rounded-full shadow m-2" src="data:image/jpg;base64,{{ $vote->user->profile_picture }}"  />
                                <div class="font-bold">
                                    <a class="hover:underline underline-offset-4 transition-all " href="/user/{{ $vote->user->name }}">
                                        {{ $vote->user->name }}
                                    </a>

                                </div>
                                <div class="font-medium text-lg">
                                    @if($vote->team1_vote !== null && $vote->team2_vote !== null)
                                        {{ $vote->team1_vote }} : {{ $vote->team2_vote }}
                                    @else
                                        <i class="font-normal italic text-sm">kein Tipp abgegeben</i>
                                    @endif
                                </div>
                                <div class="">
                                    <span class="font-bold">Punkte: </span> {{ $vote->points }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
    </div>
    </div>
    @else
        <i>Du kannst die Tipps deiner Mitspieler:innen erst sehen, wenn das Spiel angefangen hat.</i>
    @endif
</x-layout>
