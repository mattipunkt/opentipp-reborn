<x-layout>
    <div class="d-flex justify-content-between">
        <h1>
            Punktetabelle
        </h1>    
    </div>

    <br>
    <p>
        Bitte beachte, dass die Punkte nur alle <b>30 Minuten</b> aktualisiert werden. Es kann also sein, dass
        du erst später deinen Sieg begutachten kannst.
    </p>
    <ul class="list-group list-group-flush">
        <li class="list-group-item">
            <div class="d-flex justify-content-between">
                <b>Nutzername</b>
                <b>Punkte</b>
            </div>
        </li>
        @foreach($users as $user)
        <li class="list-group-item">
            <div class="d-flex justify-content-between">
                    <div>{{ $user->name }}</div>
                    <div>{{ $user->points }}</div>     
            </div>
        </li>
        @endforeach
      </ul>
</x-layout>