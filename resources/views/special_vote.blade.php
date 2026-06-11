<x-layout>

    <h1 class="text-4xl font-bold mb-2">
        Sondertipp
    </h1>
    @if(session('success'))
        <div class="alert alert-success text-base-100 shadow text-shadow my-2">
            {{ session('success') }}
        </div>
    @endif
    <form action="/special" method="POST">
        @csrf
    <div class="grid grid-cols-1 gap-2 mb-3">
        <div class="card card-border bg-base-200 shadow">
            <div class="card-body">
                <div class="text-xl">Wer wird das Turnier gewinnen?</div>
                <i>Hast du diesen Tipp richtig, bekommst du am Ende 10 Punkte extra berechnet.</i>

        <select class="select w-full" name="team_id" id="team_id" @if($allowedToChange == true) disabled @endif>
            <option value="null" @if($user->team_id === null) selected @endif>--</option>
            @foreach ($teams as $team)
                <option value="{{ $team->id }}" @if($user->team_id == $team->id) selected @endif>
                    {{ $team->name }} {{ $team->icon_url }}
                </option>
            @endforeach
        </select>

            </div></div>
        <button type="submit" class="btn btn-neutral mt-2">
            Speichern
        </button>
</div>

    </form>


</x-layout>
