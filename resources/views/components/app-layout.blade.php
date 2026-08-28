@php
    use App\Services\FileStorageService;

    $logoPath = app(FileStorageService::class)->portalLogoUrl($portal);
    $userLogoPath = app(FileStorageService::class)->userProfilePicture(auth()->user());
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $portal->name ?? 'Dashboard' }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    @livewireStyles

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <link rel="icon" type="image" href="{{ $logoPath ?? asset('portalEaseLogo.png') }}">
</head>

<body class="bg-gray-100 text-[#1b1b18] min-h-screen flex font-sans">
    <!-- Sidebar -->
    <aside class="w-64 text-white p-6 flex flex-col shadow-lg" style="background-color: {{ $portal->branding_color }}">
        <nav class="flex flex-col space-y-4 flex-grow">

            <!-- Logo -->
            <a href="{{ route('portal.show', ['portal' => $portal]) }}" class="self-center mb-4" wire:navigate.hover>
                <img src="{{ $logoPath ?? asset('portalEaseLogo.png') }}" alt="{{ $portal->name ?? 'logo' }}"
                    class="max-h-12">
            </a>

            <!-- Dashboard -->
            <a href="{{ route('portal.show', ['portal' => $portal]) }}" wire:navigate.hover
                class="flex items-center gap-2 text-xl font-bold focus-visible:outline focus-visible:outline-2 focus-visible:outline-white transition
                {{ request()->routeIs('portal.show')
                    ? 'border-l-4 border-white pl-3'
                    : 'pl-3 hover:border-l-4 hover:border-white' }}">
                <x-lucide-layout-dashboard width="22" height="22" />
                Dashboard
            </a>

            @if (Auth::user()->hasRole('service_provider'))

                <!-- Customers -->
                <a href="{{ route('portal.user.index', $portal) }}" wire:navigate.hover
                    class="flex items-center gap-2 text-lg focus-visible:outline focus-visible:outline-2 focus-visible:outline-white transition
                    {{ request()->routeIs('portal.user.*')
                        ? 'border-l-4 border-white pl-3'
                        : 'pl-3 hover:border-l-4 hover:border-white' }}">
                    <x-lucide-users width="22" height="22" />
                    Customers
                </a>

                <!-- Invoices -->
                <a href="{{ route('portal.invoice.index', $portal) }}" wire:navigate.hover
                    class="flex items-center gap-2 text-lg focus-visible:outline focus-visible:outline-2 focus-visible:outline-white transition
                    {{ request()->routeIs('portal.invoice.*')
                        ? 'border-l-4 border-white pl-3'
                        : 'pl-3 hover:border-l-4 hover:border-white' }}">
                    <x-lucide-file-text width="22" height="22" />
                    Invoices
                </a>

                <!-- Projects -->
                <a href="{{ route('portal.project.index', $portal) }}" wire:navigate.hover
                    class="flex items-center gap-2 text-lg focus-visible:outline focus-visible:outline-2 focus-visible:outline-white transition
                    {{ request()->routeIs('portal.project.*')
                        ? 'border-l-4 border-white pl-3'
                        : 'pl-3 hover:border-l-4 hover:border-white' }}">
                    <x-lucide-briefcase width="22" height="22" />
                    Projects
                </a>

                <!-- Share files -->
                <a href="{{ route('portal.file.create', $portal) }}" wire:navigate.hover
                    class="flex items-center gap-2 text-lg focus-visible:outline focus-visible:outline-2 focus-visible:outline-white transition
                    {{ request()->routeIs('portal.file.create')
                        ? 'border-l-4 border-white pl-3'
                        : 'pl-3 hover:border-l-4 hover:border-white' }}">
                    <x-lucide-upload width="22" height="22" />
                    Share files/documents
                </a>

                <!-- Conversations -->
                <a href="{{ route('portal.user.chat', [
                    'portal' => $portal,
                    'user' => \Illuminate\Support\Facades\Auth::user(),
                ]) }}"
                    wire:navigate.hover
                    class="flex items-center gap-2 text-lg focus-visible:outline focus-visible:outline-2 focus-visible:outline-white transition
                    {{ request()->routeIs('portal.user.chat')
                        ? 'border-l-4 border-white pl-3'
                        : 'pl-3 hover:border-l-4 hover:border-white' }}">
                    <x-lucide-message-circle width="22" height="22" />
                    Conversations
                </a>
            @else
                <!-- Shared files -->
                <a href="{{ route('portal.file.index', $portal) }}" wire:navigate.hover
                    class="flex items-center gap-2 text-lg focus-visible:outline focus-visible:outline-2 focus-visible:outline-white transition
                    {{ request()->routeIs('portal.file.index')
                        ? 'border-l-4 border-white pl-3'
                        : 'pl-3 hover:border-l-4 hover:border-white' }}">
                    <x-lucide-folder width="22" height="22" />
                    Shared files/documents
                </a>

                <!-- Conversations -->
                <a href="{{ route('portal.user.chat', [
                    'portal' => $portal,
                    'user' => \Illuminate\Support\Facades\Auth::user(),
                ]) }}"
                    wire:navigate.hover
                    class="flex items-center gap-2 text-lg focus-visible:outline focus-visible:outline-2 focus-visible:outline-white transition
                    {{ request()->routeIs('portal.user.chat')
                        ? 'border-l-4 border-white pl-3'
                        : 'pl-3 hover:border-l-4 hover:border-white' }}">
                    <x-lucide-message-circle width="22" height="22" />
                    Conversations
                </a>

                <!-- Invoices -->
                @foreach ($portal->invoices as $invoice)
                    @if ($invoice->user->id === auth()->id())
                        <a href="{{ route('portal.invoice.show', [$portal, $invoice]) }}" wire:navigate.hover
                            class="text-lg pl-3 hover:border-l-4 hover:border-white flex items-center gap-2 focus-visible:outline focus-visible:outline-2 focus-visible:outline-white">
                            <x-lucide-receipt width="22" height="22" />
                            Invoice: {{ $invoice->name }}
                        </a>
                    @endif
                @endforeach

                <!-- Projects -->
                @foreach ($portal->projects as $project)
                    @if ($project->customer->id === auth()->id())
                        <a href="{{ route('portal.project.show', [$portal, $project]) }}?status=all"
                            wire:navigate.hover
                            class="text-lg pl-3 hover:border-l-4 hover:border-white flex items-center gap-2 focus-visible:outline focus-visible:outline-2 focus-visible:outline-white">
                            <x-lucide-clipboard-list width="22" height="22" />
                            Project: {{ $project->name }}
                        </a>
                    @endif
                @endforeach

            @endif

            <!-- Version -->
            <div class="mt-auto pt-6 text-xs text-white/70">
                <p>{{ config('app.name') }}</p>
                <p>v{{ config('portalease.version') }}</p>
            </div>

        </nav>

        <!-- Logout -->
        <div class="mt-6">
            <a href="{{ route('logout.request') }}" wire:navigate.hover
                class="flex items-center justify-center gap-2 bg-white hover:bg-gray-100 text-blue-600 font-semibold text-center py-2 rounded-3xl transition duration-200">
                <x-lucide-log-out width="22" height="22" />
                Logout
            </a>
        </div>
    </aside>

    <main class="flex-1 p-8">
        <div class="max-w-5xl mx-auto">

            <!-- Header tools -->
            <div class="flex justify-end items-center space-x-4 mb-6">

                <!-- Notifications -->
                <a href="{{ route('portal.notification.index', $portal) }}" wire:navigate.hover
                    aria-label="Notifications"
                    class="focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-300 rounded transition">
                    <x-lucide-bell width="22" height="22" class="text-black hover:text-gray-500 transition" />
                </a>

                @if (Auth::user()->hasRole('service_provider'))
                    <!-- Settings -->
                    <a href="{{ route('portal.edit', $portal) }}" aria-label="Settings"
                        class="focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-300 rounded transition">
                        <x-lucide-settings width="22" height="22"
                            class="text-black hover:text-gray-500 transition" />
                    </a>
                @endif

                <!-- Profile -->
                <a href="{{ route('portal.user.edit', [
                    'portal' => $portal,
                    'user' => \Illuminate\Support\Facades\Auth::user(),
                ]) }}"
                    aria-label="Profile">
                    @if ($userLogoPath)
                        <img src="{{ $userLogoPath }}" alt="{{ auth()->user()->name }}"
                            class="w-8 h-8 rounded-full ring-2 ring-white focus-visible:ring-4 focus-visible:ring-blue-300 transition">
                    @else
                        <img src="{{ asset('anonymous_picture.jpg') }}" alt="User profile photo"
                            class="w-8 h-8 rounded-full ring-2 ring-white focus-visible:ring-4 focus-visible:ring-blue-300 transition">
                    @endif
                </a>

            </div>

            @livewireScripts

            <!-- Slot Content -->
            {{ $slot }}

        </div>
    </main>

</body>

</html>
