<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--idera-blue, #1e3a5f);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }
        .login-card {
            width: 100%;
            max-width: 420px;
            min-height: 500px;
            background-color: white;
            border-radius: 24px;
            box-shadow: 0 25px 50px rgba(37, 99, 235, 0.4), 0 10px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }
        .login-form-container {
            flex: 1;
            padding: 2rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 1.5rem;
            overflow-y: auto;
        }
        /* Inputs */
        .login-form-container input[type="email"],
        .login-form-container input[type="password"] {
            font-size: 0.875rem !important;
            padding: 0.75rem 1rem !important;
            height: auto !important;
        }
        .login-form-container input::placeholder {
            font-size: 0.875rem;
            opacity: 0.7;
        }
        
        .login-button {
            width: 100%;
            max-width: 260px;
            padding: 0.875rem 1.75rem;
            font-size: 0.95rem;
            font-weight: 600;
            height: 2.75rem;
            margin: 1rem 0 0 0;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
        @media (max-width: 480px) {
            .login-card {
                max-width: 95vw;
                border-radius: 16px;
            }
            .login-form-container {
                padding: 1.5rem;
                gap: 1.25rem;
            }
            .login-button {
                max-width: 240px;
                padding: 0.8125rem 1.25rem;
                height: 2.5rem;
                font-size: 0.9rem;
            }
            .login-form-container input::placeholder {
                font-size: 0.85rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-form-container">
            {{ $slot }}
        </div>
    </div>
</body>
</html>
