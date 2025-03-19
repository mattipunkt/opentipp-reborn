<x-layout>
    <h1>
        Nutzer bearbeiten
    </h1>
    <br>
    <h3>Neue Nutzer</h3>
        @if(count($unaccepted_users)>0) 
        <p>Diese Nutzer müssen bestätigt werden, damit sie sich anmelden können.</p>
        @else
        <p>Wenn sich neue Nutzer registrieren, müssen sie erst von dir zugelassen werden. Diese Tauchen dann hier auf</p>
        <b>...</b>
        @endif
        
        <ul class="list-group">
            @foreach($unaccepted_users as $user)
                <li class="list-group-item">
                    <div class="d-flex justify-content-between">
                       <div>
                           <b>Vorname:</b>{{ $user->first_name }}<br>
                            <b>Nutzername: </b>{{ $user->name }}<br>
                            <b>E-Mail-Adresse: </b>{{ $user->email }}<br>
                       </div>
                        <div>
                            <a type="button" class="btn btn-success btn-sm" href="/admin/users?action=activate&id={{ $user->id }}&activate=true">Nutzer aktivieren</a><br>
                            <a type="button" class="btn btn-danger btn-sm" href="/admin/users?action=activate&id={{ $user->id }}&activate=false" style="margin-top: 10px">Nutzer löschen</a>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
        <br>




        <h3>User-Liste</h3>
        <ul class="list-group">
            @foreach($accepted_users as $user)
                @if($user->is_admin)
                <li class="list-group-item list-group-item-info">
                @else
                    <li class="list-group-item">
                @endif
                    <div class="d-flex justify-content-between">
                       <div>
                           <b>Vorname:</b> {{ $user->first_name }}<br>
                            <b>Nutzername: </b>{{ $user->name }}<br>
                            <b>E-Mail-Adresse: </b>{{ $user->email }}<br>
                       </div>
                        <div>
                            @if($user->is_admin)
                            <span
                                class="badge bg-info mb-1"
                                >Superuser</span
                            ><br>
                            
                            @endif
                            <a type="button" class="btn btn-danger btn-sm" href="/admin/users?action=activate&id={{ $user->id }}&activate=false">Nutzer löschen</a>
                            @if(!$user->is_admin)
                                <br>
                            <a type="button" class="btn btn-warning btn-sm" href="/admin/users?action=superuser&id={{ $user->id }}&activate=true" style="margin-top: 10px">Admin machen</a>
                            @endif
                        </div>
                    </div>
            </li>
            @endforeach
        </ul>
</x-layout>