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
                class="form-control"
                name="profile_picture"
                id="profile_picture"
                placeholder=""
                accept="image/jpeg,image/jpg,image/png"
            />
            <label for="profile_picture">Profilbild</label>
        </div>
        <button type="submit" class="btn btn-primary">Profilbild ändern</button>
    </form>
</x-layout>