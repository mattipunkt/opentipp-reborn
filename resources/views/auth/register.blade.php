<x-layout>
    <h1 class="text-4xl font-bold mb-2">
        Registrieren
    </h1>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            @if ($errors->has('password'))
            <div class="alert alert-danger" role="alert">
                <strong>Fehler!</strong> {{ $errors->first('password') }}
            </div>
            @else
            <div class="alert alert-danger" role="alert">
                <strong>Fehler!</strong> {{ $error }}
            </div>
            @endif
        @endforeach
    @endif
    <form action="/register" method="post">
        @csrf
        <label class="input w-full mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-raised-hand" viewBox="0 0 16 16">
                <path d="M6 6.207v9.043a.75.75 0 0 0 1.5 0V10.5a.5.5 0 0 1 1 0v4.75a.75.75 0 0 0 1.5 0v-8.5a.25.25 0 1 1 .5 0v2.5a.75.75 0 0 0 1.5 0V6.5a3 3 0 0 0-3-3H6.236a1 1 0 0 1-.447-.106l-.33-.165A.83.83 0 0 1 5 2.488V.75a.75.75 0 0 0-1.5 0v2.083c0 .715.404 1.37 1.044 1.689L5.5 5c.32.32.5.754.5 1.207"/>
                <path d="M8 3a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3"/>
            </svg>
            <input
                type="text"
                class="grow"
                name="first_name"
                id="first_name"
                placeholder="Vorname"
                required
            />
        </label>
        <label class="input w-full mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-badge-fill" viewBox="0 0 16 16">
                <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2zm4.5 0a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1zM8 11a3 3 0 1 0 0-6 3 3 0 0 0 0 6m5 2.755C12.146 12.825 10.623 12 8 12s-4.146.826-5 1.755V14a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1z"/>
            </svg>
            <input
                type="text"
                class="grow"
                name="name"
                id="name"
                placeholder="Nutzername"
                required
            />
        </label>
        <label class="input w-full mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414zM0 4.697v7.104l5.803-3.558zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586zm3.436-.586L16 11.801V4.697z"/>
            </svg>
            <input
                type="email"
                class="grow"
                name="email"
                id="email"
                placeholder="Mail-Adresse"
                required
            />
        </label>
        <label class="input w-full mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M8 0a4 4 0 0 1 4 4v2.05a2.5 2.5 0 0 1 2 2.45v5a2.5 2.5 0 0 1-2.5 2.5h-7A2.5 2.5 0 0 1 2 13.5v-5a2.5 2.5 0 0 1 2-2.45V4a4 4 0 0 1 4-4M4.5 7A1.5 1.5 0 0 0 3 8.5v5A1.5 1.5 0 0 0 4.5 15h7a1.5 1.5 0 0 0 1.5-1.5v-5A1.5 1.5 0 0 0 11.5 7zM8 1a3 3 0 0 0-3 3v2h6V4a3 3 0 0 0-3-3"/>
            </svg>

            <input
                type="password"
                class="grow"
                name="password"
                id="password"
                placeholder="Passwort (min. 8 Zeichen)"
                required
            />
        </label>
        <label class="input w-full mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M8 0a4 4 0 0 1 4 4v2.05a2.5 2.5 0 0 1 2 2.45v5a2.5 2.5 0 0 1-2.5 2.5h-7A2.5 2.5 0 0 1 2 13.5v-5a2.5 2.5 0 0 1 2-2.45V4a4 4 0 0 1 4-4m0 1a3 3 0 0 0-3 3v2h6V4a3 3 0 0 0-3-3"/>
            </svg>
            <input
                type="password"
                class="grow"
                name="password_confirmation"
                id="password_confirmation"
                placeholder="Passwort wiederholen"
                required
            />
        </label>
        <button
            type="submit"
            class="btn btn-neutral w-full"
        >
            Registrieren!
        </button>

    </form>


</x-layout>
