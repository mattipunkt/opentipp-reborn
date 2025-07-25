<!DOCTYPE html>
<html lang="de" data-bs-theme="auto">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>openTipp</title>
      <link rel="icon" type="image/x-icon" href="/favicon.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
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
<body>
    <nav
        class="navbar navbar-expand-md align-items-center border-bottom border-body"
    >
        <div class="container">
            <a class="navbar-brand" href="/"><img src="/logo.svg" alt="openTipp" height="24"/></a>
            <button
                class="navbar-toggler d-lg-none align-items-center"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#collapsibleNavId"
                aria-controls="collapsibleNavId"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="/vote" aria-current="page"
                            ><i class="bi bi-123"> </i> Tippen
                            <span class="visually-hidden">(current)</span></a
                        >
                    </li>
                    <!--
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="bi bi-megaphone"> </i> Spezialtipps</a>
                    </li>
                -->
                    <li class="nav-item">
                        <a class="nav-link" href="/ranks"><i class="bi bi-table"> </i> Punktetabelle</a>
                    </li>
                    @admin

                    <li class="nav-item">
                        <div class="nav-link" href="/admin/users">
                            <span class="badge text-bg-info">Admin-Bereich</span>

                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin/users">
                            <i class="bi bi-people">  </i>
                            Nutzer:innen
                        </a>
                    </li>
                    @endadmin
                </ul>
                <ul class="navbar-nav ms-auto">
                    @auth

                    @endauth
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="/login"><i class="bi bi-door-open"> </i> Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/register"><i class="bi bi-box-arrow-in-right"> </i> Registrieren</a>
                    </li>
                    @endguest
                    @auth
                    <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-fill"> </i>
                            <i>Hallo, {{ Auth::user()->name }}!</i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/profilepicture"><i class="bi bi-vignette"> </i> Profilbild ändern</a></li>
                            <form action="/logout" method="post">
                                @csrf
                            <li class="">
                                <button class="dropdown-item"><i class="bi bi-door-closed"> </i> Logout</button>
                            </li>
                            </form>
                        </ul>
                    </li>



                    </li>
                    @endauth
                    <li class="nav-item">
                        <div class="nav-link">
                            <a href="https://github.com/mattipunkt/openTipp-reborn" class="badge text-bg-dark"><i class="bi bi-github"> </i> openTipp v1.0.6</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <br>
        @if(session('status'))
            <div class="alert alert-info">
                {{ session('status') }}
            </div>
            <br>
        @endif
        {{ $slot }}
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script>
            ;(function () {
    const htmlElement = document.querySelector("html")
    if(htmlElement.getAttribute("data-bs-theme") === 'auto') {
        function updateTheme() {
            document.querySelector("html").setAttribute("data-bs-theme",
                window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light")
        }

        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', updateTheme)
        updateTheme()
    }
})()
        </script>
</body>
</html>
