<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Hatton Consultation Center</title>

    <!-- Styles -->
    <style>
        body {
            font-family: 'Figtree', sans-serif;
            background-color: #f3f4f6;
            color: #1f2937;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background-image: url('/images/bg.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            backdrop-filter: blur(8px); 
        }

        .container {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 0.5rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            padding: 2rem;
            max-width: 600px;
            text-align: center;
            position: relative;
        }

        h1 {
            font-size: 2rem;
            font-weight: 600;
            color: #111827;
        }

        p {
            margin-top: 1rem;
            color: #6b7280;
        }


        .auth-links {
            position: absolute;
            top: 1rem;
            right: 1rem;
        }

        .auth-links a {
            margin-left: 1rem;
            color: #6954a8;
            text-decoration: none;
            font-weight: 600;
        }

        .auth-links a:hover {
            color: #886CC0;
        }
    </style>
</head>

<body>
    <div class="container">
        @if (Route::has('login'))
            <div class="auth-links">
                @auth
                    <a href="{{ url('/dashboard') }}">Dashboard</a>
                @else
                    <a href="{{ route('login') }}">Log in</a>
                @endauth
            </div>
        @endif

        <h1>Welcome to Hatton Consultation Center</h1>
        <p>Your health is our priority. At Hatton Consultation Center, we provide top-notch medical services to ensure
            your well-being. Our team of experienced professionals is here to offer personalized care and support.</p>
    </div>
</body>

</html>
