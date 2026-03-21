<x-layout>
    <h1 class="text-4xl mb-2 font-bold">
        Login
    </h1>
    <br>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            @if ($errors->has('password'))
            <div class="alert alert-danger mb-2" role="alert">
                <strong>Fehler!</strong> {{ $errors->first('password') }}
            </div>
            @else
            <div class="alert alert-danger mb-2" role="alert">
                <strong>Fehler!</strong> {{ $error }}
            </div>
            @endif
        @endforeach
    @endif
    <form action="/login" method="post">
        @csrf
        <label class="input mb-3 w-full">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
            </svg>
            <input
                type="email"
                class="grow w-full"
                name="email"
                id="email"
                placeholder="Mail-Adresse"
            />
        </label>
        <label class="input mb-3 w-full">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-key-fill" viewBox="0 0 16 16">
                <path d="M3.5 11.5a3.5 3.5 0 1 1 3.163-5H14L15.5 8 14 9.5l-1-1-1 1-1-1-1 1-1-1-1 1H6.663a3.5 3.5 0 0 1-3.163 2M2.5 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
            </svg>
            <input
                type="password"
                class="grow w-full"
                name="password"
                id="password"
                placeholder="Passwort"
            />
        </label>
        <button
            type="submit"
            class="btn btn-neutral w-full"
        >
            Einloggen
        </button>

    </form>
</x-layout>
