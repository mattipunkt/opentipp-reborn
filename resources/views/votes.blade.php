<x-layout>
    @php
        $tabIndex = 1;
    @endphp
    <h1 class="text-4xl font-bold mb-2">
        Tippen!
    </h1>
    <p class="mb-2">
        Hier kannst du deine Tipps abgeben. Vergiss nicht, vor Spielbeginn zu tippen und deine Tipps zu speichern!
    </p>
    @if(session('success'))
        <div class="alert alert-success text-base-100 shadow text-shadow my-2">
            {{ session('success') }}
        </div>
    @endif

    <div class="card card-border shadow bg-base-200">
    <div class="card-body">
        <ul class="md:grid hidden grid-cols-6 gap-2">
            @foreach($gametypes as $gt)
                <li class="">
                    <a class="w-full btn @if($gt->id == $gtid) font-bold btn-neutral @else  @endif " aria-current="page" href="vote?gt={{ $gt->id }}" >{{ $gt->name }}</a>
                </li>
            @endforeach
        </ul>

    <details class="dropdown md:hidden">

        <summary class="btn w-full bg-base-100">
        @foreach($gametypes as $gt)
            @if($gt->id == $gtid) {{ $gt->name }} @endif
        @endforeach
        </summary>

        <ul class="menu menu-horizontal dropdown-content z-10 w-full h-40 overflow-scroll bg-base-100 rounded-box mt-2 p-2 shadow">
        @foreach($gametypes as $gt)
            <li class="w-full @if($gt->id == $gtid) font-bold @endif"><a href="vote?gt={{ $gt->id }}">{{ $gt->name }}</a></li>
        @endforeach
        </ul>
    </details>

        <div class="mt-8">
            <form method="post" action="/vote?gt={{ $gtid }}">
                @csrf
                @foreach($votes as $vote)
                    <div class="grid md:grid-cols-13 grid-cols-11 mb-4 mb-md-2 align-center items-center text-center">
                        <div class="md:col-span-2 col-span-12 md:text-left text-center">
                            <span class="break-words min-w-0 block"><b>{{ $vote->game->time->format('d.m.Y, H:i') }}</b></span>
                        </div>

                        <!-- Team 1 Name -->
                        <div class="md:col-span-3 min-w-0  col-span-3 md:text-center text-left">
                            <span class="break-words min-w-0 block">{{ $vote->game->team1->name }}</span>
                        </div>
                        <div class="md:col-span-1 hidden md:block ">
                            <span >{{ $vote->game->team1->icon_url }}</span>
                        </div>
                        <div class="md:block hidden col-span-1">
                            @if($vote->game->is_finished)
                                <div class="col-span-12">
                                    <i>({{ $vote->game->team1_score }} : {{ $vote->game->team2_score }})</i>
                                </div>
                            @endif

                        </div>
                        <!-- Punkt-Eingabe -->
                        <div class="md:col-span-2 col-span-5 w-full">

                            <div class="flex justify-center align-center items-center gap-1">
                                <input type="hidden" name="votes[{{ $vote->game->id }}][game_id]" value="{{ $vote->game->id }}">
                                <input tabindex="{{ $tabIndex++ }}" type="number" class="bg-base-100 rounded shadow px-1 disabled:opacity-50" pattern="[0-9]*" maxlength="2" style="width:50px" name="votes[{{ $vote->game->id }}][team1_score]" value="{{ $vote->team1_vote }}" @if($vote->game->time->isPast()) disabled @endif>
                                <span>:</span>
                                <input tabindex="{{ $tabIndex++ }}" type="number" class="bg-base-100 rounded shadow px-1 disabled:opacity-50" pattern="[0-9]*" maxlength="2" style="width: 50px;" name="votes[{{ $vote->game->id }}][team2_score]" value="{{ $vote->team2_vote }}" @if($vote->game->time->isPast()) disabled @endif>
                            </div>
                        </div>

                        <!-- Team 2 Name -->
                        <div class="md:col-span-1 md:block hidden ">
                            <span>{{ $vote->game->team2->icon_url }}</span>
                        </div>
                        <div class="md:col-span-3 w-full min-w-0 col-span-3 md:text-center text-right break-words">
                            <span class="break-words min-w-0 block"> {{ $vote->game->team2->name }}</span>
                        </div>
                        @if($vote->game->is_finished)
                            <div class="md:hidden block mt-1 col-span-12">
                                <i>({{ $vote->game->team1_score }} : {{ $vote->game->team2_score }})</i>
                            </div>
                        @endif



                    </div>
                @endforeach
                <div class="text-center text-md-start mb-3">
                    <button type="submit" class="btn btn-neutral w-full">
                        Speichern
                    </button>
                </div>
            </form>
    </div>
        </div>
    </div>


</x-layout>
