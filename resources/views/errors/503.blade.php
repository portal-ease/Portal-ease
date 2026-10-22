<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>503 - Under Maintenance | PortalEase</title>
    <link rel="icon" href="{{ asset('portalEaseLogo.png') }}" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex min-h-screen items-center justify-center bg-gray-50 px-6 py-12">
    <main class="flex w-full max-w-3xl flex-col items-center text-center">
        <img src="{{ asset('portalEaseLogo.png') }}" class="mb-12 w-16" alt="PortalEase logo" />

        <div class="mb-6 flex h-40 w-40 items-center justify-center rounded-full bg-blue-50">
            <x-lucide-wrench class="h-20 w-20 text-blue-600" />
        </div>

        <p class="text-7xl font-extrabold tracking-tight text-blue-600">503</p>

        <h1 class="mt-6 text-3xl font-bold text-gray-900">We're currently under maintenance</h1>

        <p class="mt-4 max-w-xl text-lg leading-8 text-gray-600">
            Our website is temporarily unavailable while we perform some maintenance. Please try again later.
        </p>

        <div class="mt-8 flex flex-col justify-center gap-4 sm:flex-row">
            <a
                href="{{ url('/') }}"
                class="inline-flex items-center justify-center gap-2 rounded-lg bg-blue-600 px-5 py-3 font-medium text-white transition hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:outline-none"
            >
                <x-lucide-house class="h-5 w-5" />
                Go back home
            </a>

            <button
                type="button"
                onclick="window.location.reload()"
                class="inline-flex cursor-pointer items-center justify-center gap-2 rounded-lg border border-gray-300 bg-white px-5 py-3 font-medium text-gray-700 transition hover:bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:outline-none"
            >
                <x-lucide-refresh-cw class="h-5 w-5" />
                Try again
            </button>
        </div>
    </main>
</body>
</html>
