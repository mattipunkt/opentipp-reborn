<x-layout>
    <h1>
        Login
    </h1>
    <br>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger" role="alert">
                <strong>Fehler!</strong> {{ $error }}
            </div>
        @endforeach
    @endif  
    <form action="/login" method="post">  
        @csrf
        <div class="form-floating mb-3">
            <input
                type="email"
                class="form-control"
                name="email"
                id="email"
                placeholder=""
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
            />
            <label for="password">Passwort</label>
        </div>
        <button
            type="submit"
            class="btn btn-primary"
        >
            Einloggen
        </button>
        
    </form>
</x-layout>