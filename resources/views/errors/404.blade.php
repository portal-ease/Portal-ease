<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Page Not Found</title>
    <link rel="icon" href="{{ asset('portalEaseLogo.png') }}" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex min-h-screen items-center justify-center bg-gray-50 px-6">
    <div class="flex max-w-xl flex-col items-center text-center">
        <img src="{{ asset('portalEaseLogo.png') }}" class="w-16" alt="logo" />

        <p class="text-7xl font-extrabold text-blue-600">404</p>

        <h1 class="mt-6 text-3xl font-bold text-gray-900">Page not found</h1>

        <p class="mt-4 text-gray-600">
            Sorry, we couldn't find the page you're looking for. It may have been moved, deleted, or the URL may be
            incorrect.
        </p>

        <div class="mt-8 flex justify-center gap-4">
            <a
                href="{{ url('/') }}"
                class="rounded-lg bg-blue-600 px-5 py-3 font-medium text-white transition hover:bg-blue-700"
            >
                Go back home
            </a>

            <button
                onclick="history.back()"
                class="cursor-pointer rounded-lg border border-gray-300 bg-white px-5 py-3 font-medium text-gray-700 transition hover:bg-gray-50"
            >
                Go back
            </button>
        </div>
    </div>
</body>
</html>
