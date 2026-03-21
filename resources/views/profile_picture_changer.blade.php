<x-layout>
    <h1 class="text-4xl font-bold mb-2">
        Profil ändern
    </h1>
    <div class="text-xl font-bold">
        Profildetails ändern
    </div>
    <form action="/profilesettings" method="post" class="mb-4">
        @csrf
        <label class="input mb-3 w-full">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
            </svg>
            <input class="grow" type="text" id="first_name" name="first_name" placeholder="Vorname" value="{{ auth()->user()->first_name }}">
        </label>
        <label class="input mb-3 w-full">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6"/>
            </svg>
            <input class="grow" type="text" id="location" name="location" placeholder="Ort (optional)" value="{{ auth()->user()->location }}">
        </label>
        <label class="input mb-3 w-full">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>
            </svg>
            <input class="grow" type="text" id="slogan" name="slogan" placeholder="Schreib etwas über dich, wenn du magst! (optional)" value="{{ auth()->user()->slogan }}">
        </label>
        <button type="submit" class="btn btn-neutral">Speichern</button>


    </form>

    <div class="text-xl font-bold">
        Profilbild ändern
    </div>
    <p class="mb-2">
        Hier kannst du dein Profilbild ändern. Das Bild wird auf den Server hochgeladen und in deinem Profil angezeigt.
        Beachte, dass das Bild nicht größer als 8MB sein darf und die Dateiendung .jpg, .jpeg oder .png haben muss.
        Wenn dein Bild nicht quadratisch ist, wird es beim skalieren gequetscht, also achte darauf, dass du ein Quadratisches Bild hochlädst!
    </p>
    <form method="post" action="/profilepicture" enctype="multipart/form-data">
        @csrf
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="form mb-3">
            <input
                type="file"
                class="file-input w-full"
                name="profile_picture"
                id="profile_picture"
                placeholder=""
                accept="image/jpeg,image/jpg,image/png"
            />
        </div>
        <button type="submit" class="btn btn-neutral">Profilbild ändern</button>
    </form>
</x-layout>
