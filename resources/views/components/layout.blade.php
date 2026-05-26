<!DOCTYPE html>
<html lang="de" data-bs-theme="auto" class="bg-base-300">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>openTipp</title>
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=SN+Pro:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite('resources/css/app.css')
    <style>
        body {
            font-family: "SN Pro", sans-serif;
        }

        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }

        [data-bs-theme="dark"] .navbar-brand img {
            filter: invert(1) hue-rotate(180deg);
        }
    </style>

</head>
<body class="bg-base-300">
    <div class="md:container md:mx-auto mx-2 bg-base-300">
        <nav
            class="p-2 my-2 rounded shadow bg-base-200 mb-4 items-center align-baseline"
        >
            <div class="container mx-auto md:flex hidden items-center justify-between">
                <div class="items-center gap-3 md:flex hidden">
                    <a class="navbar-brand" href="/">
                        <img class="w-30 dark:invert" src="/logo.svg" alt="openTipp" height="24"/></a>
                    <div class="flex gap-2">
                        <div>
                            <a href="/vote" aria-current="page"
                            ><i class="bi bi-123"> </i> Tippen
                        </div>
                        <!--
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="bi bi-megaphone"> </i> Spezialtipps</a>
                        </li>
                    -->
                        <div>
                            <a href="/ranks"><i class="bi bi-table"> </i> Punktetabelle</a>
                        </div>
                        @admin

                        <div>
                            <a href="/admin/users">
                                <span class="badge text-bg-info">Admin-Bereich</span>
                            </a>
                        </div>
                        <div>
                            <a href="/admin/users">
                                <i class="bi bi-people"> </i>
                                Nutzer:innen
                            </a>
                        </div>
                        @endadmin
                    </div>
                </div>
                <div class="navbar-nav ms-auto flex gap-2">
                    @guest
                        <div>
                            <a class="nav-link" href="/login"><i class="bi bi-door-open"> </i> Login</a>
                        </div>
                        <div>
                            <a class="nav-link" href="/register"><i class="bi bi-box-arrow-in-right"> </i> Registrieren</a>
                        </div>
                    @endguest
                    @auth
                        <a href="#" role="button">
                            <i class="bi bi-person-fill"> </i>
                            <i>Hallo, {{ Auth::user()->name }}!</i>
                        </a>
                        <a href="/profilesettings"><i class="bi bi-pencil"> </i> Profil bearbeiten</a>
                        <form action="/logout" method="post">
                            @csrf
                            <button class="dropdown-item"><i class="bi bi-door-closed"> </i> Logout</button>
                        </form>
                    @endauth
                    <div>
                        <a href="https://github.com/mattipunkt/openTipp-reborn" class="badge text-bg-dark"><i
                                class="bi bi-github"> </i> openTipp v2.0.2</a>
                    </div>
                </div>
            </div>
            <div class="md:hidden">
                <div class="md:hidden flex justify-between items-center">
                    <a class="navbar-brand" href="/"><img class="w-30 dark:invert" src="/logo.svg" alt="openTipp" height="24"/></a>
                    <i class="bi bi-list cursor-pointer" id="mobile-nav-button"></i>
                </div>
                <div id="mobile-nav-list" class="grid gap-2 mt-2 mx-2 md:hidden">
                        <div>
                            <a href="/vote" aria-current="page"
                            ><i class="bi bi-123"> </i> Tippen</a>
                        </div>
                        <div>
                            <a href="/ranks"><i class="bi bi-table"> </i> Punktetabelle</a>
                        </div>
                        @admin

                        <div>
                            <div href="/admin/users">
                                <span class="badge text-bg-info">Admin-Bereich</span>
                            </div>
                        </div>
                        <div>
                            <a href="/admin/users">
                                <i class="bi bi-people"> </i>
                                Nutzer:innen
                            </a>
                        </div>
                        @endadmin
                    <hr>
                    @guest
                        <div>
                            <a class="nav-link" href="/login"><i class="bi bi-door-open"> </i> Login</a>
                        </div>
                        <div>
                            <a class="nav-link" href="/register"><i class="bi bi-box-arrow-in-right"> </i> Registrieren</a>
                        </div>
                    @endguest
                    @auth
                        <a href="#" role="button">
                            <i class="bi bi-person-fill"> </i>
                            <i>Hallo, {{ Auth::user()->name }}!</i>
                        </a>
                        <a href="/profilesettings"><i class="bi bi-pencil"> </i> Profilbild ändern</a>
                        <form action="/logout" method="post">
                            @csrf
                            <button class="dropdown-item"><i class="bi bi-door-closed"> </i> Logout</button>
                        </form>
                    @endauth
                    <div>
                        <a href="https://github.com/mattipunkt/openTipp-reborn" class="badge text-bg-dark"><i
                                class="bi bi-github"> </i> openTipp v2.0.2</a>
                    </div>
                </div>

            </div>
        </nav>

        @if(session('status'))
            <div class="alert alert-info">
                {{ session('status') }}
            </div>
            <br>
        @endif
        {{ $slot }}
    </div>
</body>
<script>
    const menuBtn = document.getElementById('mobile-nav-button');
    const navList = document.getElementById('mobile-nav-list');
    menuBtn.addEventListener('click', () => {
        navList.classList.toggle('hidden');

    })

</script>
</html>
