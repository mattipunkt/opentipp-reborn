<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body>
    <nav
        class="navbar navbar-expand-md navbar-light bg-light"
    >
        <div class="container">
            <a class="navbar-brand" href="#">openTipp</a>
            <button
                class="navbar-toggler d-lg-none"
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
                        <a class="nav-link" href="/tippen" aria-current="page"
                            ><i class="bi bi-123"> </i> Tippen
                            <span class="visually-hidden">(current)</span></a
                        >
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="bi bi-megaphone"> </i> Spezialtipps</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="bi bi-table"> </i> Punktetabelle</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto text-end">
                    @auth
                    <form action={{ route('logout') }} method="post">
                        @csrf
                        <li class="nav-item">
                            <button class="nav-link"><i class="bi bi-door-closed"> </i> Logout</button>
                        </li>
                    </form>
                    @endauth
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="/login"><i class="bi bi-door-open"> </i> Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/register"><i class="bi bi-box-arrow-in-right"> </i> Registrieren</a>
                    </li>
                    @endguest
                    @admin
                    <li class="nav-item">
                        <a class="nav-link" href="/users">
                            <i>Nutzer</i>
                        </a>
                    </li>
                    @endadmin
                </ul>
            </div>
        </div>
    </nav>
    
    <div class="container">
        <br>
        {{ $slot }}
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>