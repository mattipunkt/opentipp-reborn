<x-layout>
    <h1>
        Tippen!
    </h1>
    <ul class="nav nav-pills nav-justified">
        @foreach($gametypes as $gt)
        <li class="nav-item">
          <a class="nav-link @if($gt->id == $gtid) active @endif" aria-current="page" href="vote?gt={{ $gt->id }}">{{ $gt->name }}</a>
        </li>
        @endforeach

    </ul>

    <br>
    <form method="post" action="/vote?gt={{ $gtid }}">
    @csrf
    @foreach($votes as $vote)
    <div class="row mb-3 align-self-center">
        <div class="col-2 align-right">
            {{ $vote->game->team1->name }}
        </div>
        <div class="col-auto">
            <img src="" class="rounded" style="height: 20px; width: 30px; object-fit: contain; object-position: 100% 0;" alt="">
        </div>
        <div class="col-3">
            <div class="d-flex">
                <input type="hidden" name="votes[{{ $vote->game->id }}][game_id]" value="{{ $vote->game->id }}">
                <input class="form-control" maxlength="2" size="2" name="votes[{{ $vote->game->id }}][team1_score]" value="{{ $vote->team1_vote }}" @if($vote->game->is_started) disabled @endif>
                &nbsp;&nbsp;:&nbsp;&nbsp;
                <input class="form-control" maxlength="2" size="2" name="votes[{{ $vote->game->id }}][team2_score]" value="{{ $vote->team2_vote }}" @if($vote->game->is_started) disabled @endif>
            </div>
        </div>
        <div class="col-auto">
            <img src="" class="rounded" style="height: 20px; width: 30px; object-fit: contain; object-position: 100% 100%;" alt="">
        </div>
        <div class="col">
            {{ $vote->game->team2->name }}
        </div>
    </div>
    @endforeach
    <button type="submit" class="btn btn-primary">Speichern</button>
    </form>
</x-layout>