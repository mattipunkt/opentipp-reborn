<x-layout>
    <h1 class="text-4xl font-bold mb-2">
        Admin-Bereich
    </h1>
    <br>
    <h3 class="text-2xl font-medium">Neue Nutzer</h3>
        @if(count($unaccepted_users)>0)
        <p>Diese Nutzer müssen bestätigt werden, damit sie sich anmelden können.</p>
        @else
        <p>Wenn sich neue Nutzer registrieren, müssen sie erst von dir zugelassen werden. Diese Tauchen dann hier auf</p>
        <b>...</b>
        @endif

        <div class="grid gap-2">
            @foreach($unaccepted_users as $user)
                <div class="card card-border bg-base-200 shadow">

                <div class="card-body">
                    <div class="flex justify-between">
                       <div>
                           <b>Vorname:</b> {{ $user->first_name }}<br>
                            <b>Nutzername: </b>{{ $user->name }}<br>
                            <b>E-Mail-Adresse: </b>{{ $user->email }}<br>
                       </div>
                        <div>
                            <a type="button" class="btn btn-success btn-sm w-full w-max-150" href="/admin/users?action=activate&id={{ $user->id }}&activate=true">Nutzer aktivieren</a><br>
                            <a type="button" class="btn btn-danger btn-sm w-full w-max-150" href="/admin/users?action=activate&id={{ $user->id }}&activate=false" style="margin-top: 10px">Nutzer löschen</a>
                        </div>
                    </div>
                </div>
                </div>

            @endforeach
        </div>




        <h3 class="text-2xl font-medium mt-2">User-Liste</h3>
        <div class="grid gap-2">
            @foreach($accepted_users as $user)
                <div class="card card-border shadow bg-base-200">
                <div class="card-body">
                    <div class="flex justify-between ">
                       <div>
                           <b>Vorname:</b> {{ $user->first_name }}<br>
                            <b>Nutzername: </b>{{ $user->name }}<br>
                            <b>E-Mail-Adresse: </b>{{ $user->email }}<br>
                       </div>
                        <div>
                            @if($user->is_admin)
                            <span
                                class="badge bg-info mb-1 w-full w-max-150"
                                >Superuser</span
                            ><br>

                            @endif
                            <a type="button" class="btn btn-danger btn-sm w-full w-max-150" href="/admin/users?action=activate&id={{ $user->id }}&activate=false">Nutzer löschen</a>
                            @if(!$user->is_admin)
                                <br>
                            <a type="button" class="btn btn-warning btn-sm w-full w-max-150" href="/admin/users?action=superuser&id={{ $user->id }}&activate=true" style="margin-top: 10px">Admin machen</a>
                            @endif
                        </div>
                    </div>
                </div>
                </div>

            @endforeach
        </div>
    <br><br>
    <h3 class="text-2xl font-medium">
        Spiel beenden
    </h3>
    <p>Wenn das Finale vorrüber ist, kannst du hier die finalen Punkte (inkl. Sondertipp) berechnen und an alle Spieler eine Mail senden</p>
    <form action="/admin/concludeGame" method="post">
        @csrf
        <input type="submit" class="btn btn-primary mt-2" value="Spiel beenden">
    </form>
        <br><br>

        <h3 class="text-2xl font-medium">
            Letzte Aktualisierug der openLigaDB-Daten
        </h3>
        <p>
            Dies dient hauptsächlich zu Debug-Zwecken, um zu schauen, ob alle Worker laufen.
            <br>
            <b>{{ $time_output }}</b> (UTC)
        </p>
</x-layout>
