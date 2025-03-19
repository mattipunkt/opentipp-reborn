<x-layout>
    <h1>
        Registrieren
    </h1>
    <br>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
                <strong>Fehler!</strong> {{ $error }}
            </div>
        @endforeach
    @endif
    <form action="{{ route('register') }}" method="post">
        @csrf
        <div class="form-floating mb-3">
            <input
                type="text"
                class="form-control"
                name="first_name"
                id="first_name"
                placeholder=""
                required
            />
            <label for="first_name">Vorname</label>
        </div>
        <div class="form-floating mb-3">
            <input
                type="text"
                class="form-control"
                name="name"
                id="name"
                placeholder=""
                required
            />
            <label for="name">Nutzername</label>
        </div>
        <div class="form-floating mb-3">
            <input
                type="email"
                class="form-control"
                name="email"
                id="email"
                placeholder=""
                required
            />
            <label for="email">Mail-Adresse</label>
        </div>
        <div class="form-floating mb-3">
            <input
                type="password"
                class="form-control"
                name="password"
                id="password"
                placeholder=""
                required
            />
            <label for="password">Passwort (min. 8 Zeichen)</label>
        </div>
        <div class="form-floating mb-3">
            <input
                type="password"
                class="form-control"
                name="password_confirmation"
                id="password_confirmation"
                placeholder=""
                required
            />
            <label for="password_confirmation">Passwort wiederholen</label>
        </div>
        <button
            type="submit"
            class="btn btn-primary"
        >
            Registrieren!
        </button>
        
    </form>   
        
        
</x-layout>