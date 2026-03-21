<x-layout>
    <h1 class="text-4xl font-bold mb-2">
        Profilbild ändern
    </h1>
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
