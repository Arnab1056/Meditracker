<!DOCTYPE html>

<html>

<head>

    <title>MediTracker</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <style type="text/css">
        @import url(https://fonts.googleapis.com/css?family=Raleway:300,400,600);

        body {
            margin: 0;
            font-size: .9rem;
            font-weight: 400;
            line-height: 1.6;
            color: #212529;
            text-align: left;
            background-color: #f5f8fa;
        }

        .navbar-laravel {
            box-shadow: 0 2px 4px rgba(0, 0, 0, .04);
        }

        .navbar-brand,
        .nav-link,
        .my-form,
        .login-form {
            font-family: Raleway, sans-serif;
        }

        .my-form {
            padding-top: 1.5rem;
            padding-bottom: 1.5rem;
        }

        .my-form .row {
            margin-left: 0;
            margin-right: 0;
        }

        .login-form {
            padding-top: 1.5rem;
            padding-bottom: 1.5rem;
        }

        .login-form .row {
            margin-left: 0;
            margin-right: 0;
        }

        /* Additional style for the logo */
        .navbar-brand img {
            max-height: 40px; /* Adjust this according to your logo size */
        }

        /* Add this to align logo and text properly */
        .navbar-custom {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .navbar-custom .navbar-brand {
            display: flex;
            align-items: center;
        }

        .navbar-custom .navbar-brand span {
            margin-left: 10px; /* Space between the logo and the text */
            font-size: 1.5rem; /* Adjust the size of the name */
            font-weight: bold; /* Adjust the font weight of the name */
        }
    </style>

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light navbar-laravel navbar-custom">
        <div class="container">
            <!-- Logo on the left side -->
            <a class="navbar-brand" href="dashboard">
                <img src="{{ asset('images/logo.png') }}" alt="MediTracker Logo"> <!-- Adjust path to your logo -->
                <span>MediTracker</span> <!-- Name on the right side of the logo -->
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-link nav-link">Logout</button>
                            </form>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <button onclick="window.history.back()" class="btn btn-secondary mb-3">Back</button>
        @yield('content')
    </div>

</body>

</html>
