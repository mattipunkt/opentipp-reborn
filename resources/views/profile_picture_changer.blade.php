<x-layout>
    <h1>
        Profilbild ändern
    </h1>
    <br>
    <p>
        Hier kannst du dein Profilbild ändern. Das Bild wird auf den Server hochgeladen und in deinem Profil angezeigt.
        Beachte, dass das Bild nicht größer als 8MB sein darf und die Dateiendung .jpg, .jpeg oder .png haben muss.
    </p>
    <form method="post" action="/profilepicture" enctype="multipart/form-data">
        @csrf
        <div class="form-floating mb-3">
            <input
                type="file"
                class="form-control"
                name="profile_picture"
                id="profile_picture"
                placeholder=""
            />
            <label for="profile_picture">Profilbild</label>
        </div>
        <button type="submit" class="btn btn-primary">Profilbild ändern</button>
    </form>
</x-layout>