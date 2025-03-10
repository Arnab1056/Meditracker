<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pharmacy</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    @stack('head') <!-- This allows adding extra styles or scripts in individual pages -->
</head>
<body>
    <header>
        <nav>
            <!-- Add your navigation here, for example -->
            <ul>
                <li><a href="{{ route('pharmacy.register') }}">Register</a></li>
                <li><a href="{{ route('pharmacy.login') }}">Login</a></li>
                @else
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-link nav-link">Logout</button>
                        </form>
                    </li>
                @endguest
            </ul>
        </nav>
    </header>

    <main>
        <button onclick="window.history.back()" class="btn btn-secondary mb-3">Back</button>
        @yield('content') <!-- Content from the views will be injected here -->
    </main>

    <footer>
        <!-- Optional footer -->
        <p>&copy; 2025 Pharmacy App</p>
    </footer>

    @stack('scripts') <!-- For adding extra scripts in individual pages -->
</body>
</html>
