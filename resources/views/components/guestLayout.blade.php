<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Portal ease</title>
    <link rel="icon" href="{{ asset('portalEaseLogo.png') }}" />
    @livewireStyles

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>

<body class="bg-white text-[#1b1b18]">
    <!-- Header -->
    <header class="flex items-center justify-between px-8 py-4 shadow-sm">
        <!-- Logo -->
        <a href="/" class="flex items-center text-xl font-semibold text-blue-700 transition hover:text-blue-900">
            <img src="{{ asset('portalEaseLogo.png') }}" alt="PortalEase logo" class="mr-2 h-10" />
            <span> <b class="text-blue-600">P</b>ortal<b class="text-blue-600">E</b>ase </span>
        </a>

        <!-- Navigation -->
        <nav class="flex items-center gap-14">
            <a href="{{ route('features') }}" class="transition hover:text-blue-600">Features</a>
            <a href="{{ route('about') }}" class="transition hover:text-blue-600">About</a>
            <a href="{{ route('support') }}" class="transition hover:text-blue-600">Contact</a>
        </nav>

        <!-- Actions -->
        <div class="flex items-center space-x-4">
            <a
                href="{{ route('portal.index') }}"
                class="rounded-xl bg-blue-600 px-4 py-2 text-white shadow transition hover:bg-blue-700"
            >Log in</a>
        </div>
    </header>
    <!-- Main Content -->
    <div>
        <main class="flex flex-col gap-10">{{ $slot }}</main>
    </div>
    <footer class="bg-blue-900 py-12 text-white">
        <div class="mx-auto grid max-w-7xl grid-cols-1 gap-12 px-6 md:grid-cols-4 md:px-12">
            <!-- Brand -->
            <div>
                <h2 class="mb-4 text-2xl font-extrabold">Portalease</h2>
                <p class="text-sm text-blue-200">
                    Professional customer contact, without the hassle. Build your own client portal today.
                </p>
            </div>

            <!-- Links -->
            <div>
                <h3 class="mb-4 text-lg font-semibold">Company</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('welcome') }}" class="hover:underline">Home</a></li>
                    <li><a href="{{ route('support') }}" class="hover:underline">Support</a></li>
                </ul>
            </div>

            <!-- Resources -->
            <div>
                <h3 class="mb-4 text-lg font-semibold">Resources</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="hover:underline">Documentation</a></li>
                    <li>
                        <a href="https://www.youtube.com/channel/UC-HSpoaud4ZjTlPdTBtW0Ig" class="hover:underline"
                            >Tutorials</a>
                    </li>
                </ul>
            </div>

            <!-- Social -->
            <div>
                <h3 class="mb-4 text-lg font-semibold">Follow Us</h3>
                <div class="flex space-x-4">
                    <!-- Instagram -->
                    <a
                        href="https://www.instagram.com/portalease"
                        class="text-blue-200 hover:text-white"
                        aria-label="Instagram"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M7.5 2h9A5.5 5.5 0 0 1 22 7.5v9A5.5 5.5 0 0 1 16.5 22h-9A5.5 5.5 0 0 1 2 16.5v-9A5.5 5.5 0 0 1 7.5 2zm0 2A3.5 3.5 0 0 0 4 7.5v9A3.5 3.5 0 0 0 7.5 20h9a3.5 3.5 0 0 0 3.5-3.5v-9A3.5 3.5 0 0 0 16.5 4h-9zm4.5 3a5.5 5.5 0 1 1 0 11 5.5 5.5 0 0 1 0-11zm0 2a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7zm5.25-.75a1.25 1.25 0 1 1 0-2.5 1.25 1.25 0 0 1 0 2.5z" />
                        </svg>
                    </a>

                    <!-- YouTube -->
                    <a
                        href="https://www.youtube.com/channel/UC-HSpoaud4ZjTlPdTBtW0Ig"
                        class="text-blue-200 hover:text-white"
                        aria-label="YouTube"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M21.8 8.001c-.2-1.5-1.2-2.6-2.6-2.8C17.4 5 12 5 12 5s-5.4 0-7.2.2c-1.4.2-2.4 1.3-2.6 2.8C2 9.6 2 12 2 12s0 2.4.2 3.999c.2 1.501 1.2 2.6 2.6 2.8 1.8.2 7.2.2 7.2.2s5.4 0 7.2-.2c1.4-.2 2.4-1.299 2.6-2.8.2-1.599.2-3.999.2-3.999s0-2.4-.2-3.999zM10 15.3V8.7l5.2 3.3L10 15.3z" />
                        </svg>
                    </a>

                    <!-- LinkedIn -->
                    <a
                        href="https://www.linkedin.com/company/portalease/?viewAsMember=true"
                        class="text-blue-200 hover:text-white"
                        aria-label="LinkedIn"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M4.98 3.5C4.98 4.6 4.09 5.5 3 5.5S1 4.6 1 3.5 1.9 1.5 3 1.5s1.98.9 1.98 2zm.02 4H1v16h4V7.5zm7 0h-4v16h4v-8.5c0-2.4 3-2.6 3 0v8.5h4v-10c0-5-5.5-4.8-7-2.4V7.5z" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        <div class="mt-12 border-t border-blue-700 pt-6 text-center text-sm text-blue-200">
            © {{ date('Y') }} {{ config('app.name') }} <br />
            Version {{ config('portalease.version') }} <br />
            All rights reserved.
        </div>
        @livewireScripts
    </footer>
    <!-- Login Spacer -->
    @if (Route::has('login'))
        <div class="hidden h-14 lg:block"></div>
    @endif
</body>
</html>
