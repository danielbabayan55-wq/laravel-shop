<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Laravel') }}</title>
        <style>
            body {
                font-family: system-ui, -apple-system, sans-serif;
                background-color: #FDFDFC;
                color: #1b1b18;
                margin: 0;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                min-height: 100vh;
            }
            header {
                position: absolute;
                top: 24px;
                right: 32px;
                display: flex;
                gap: 16px;
            }
            header a {
                text-decoration: none;
                color: #1b1b18;
                padding: 6px 16px;
                border: 1px solid #19140035;
                border-radius: 4px;
                font-size: 14px;
            }
            header a:hover {
                border-color: #1915014a;
            }
            main {
                max-width: 600px;
                text-align: center;
                padding: 32px;
                background: #ffffff;
                border: 1px solid #e3e3e0;
                border-radius: 8px;
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            }
            h1 {
                font-size: 24px;
                margin-bottom: 12px;
            }
            p {
                color: #706f6c;
                font-size: 15px;
                line-height: 1.5;
                margin-bottom: 24px;
            }
            .links {
                display: flex;
                justify-content: center;
                gap: 16px;
            }
            .links a {
                color: #f53003;
                font-weight: 500;
                text-decoration: underline;
            }
        </style>
    </head>
    <body>
        @if (Route::has('login'))
            <header>
                @auth
                    <a href="{{ url('/dashboard') }}">Dashboard</a>
                @else
                    <a href="{{ route('login') }}">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
            </header>
        @endif

        <main>
            <h1>Let's get started</h1>
            <p>Laravel has an incredibly rich ecosystem. We suggest starting with the following.</p>
            <div class="links">
                <a href="https://laravel.com" target="_blank">Documentation</a>
                <a href="https://laracasts.com" target="_blank">Laracasts</a>
                <a href="https://laravel-news.com" target="_blank">Laravel News</a>
            </div>
        </main>
    </body>
</html>
зрз