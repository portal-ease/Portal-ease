@php
    use App\Services\FileStorageService;

    $logoPath = app(FileStorageService::class)->portalLogoUrl($portal);
    $userLogoPath = app(FileStorageService::class)->userProfilePicture(auth()->user());
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ $portal->name ?? 'Dashboard' }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    @livewireStyles

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <link rel="icon" type="image" href="{{ $logoPath ?? asset('portalEaseLogo.png') }}" />
</head>

<body class="flex min-h-screen bg-gray-100 font-sans text-[#1b1b18]">
    <!-- Sidebar -->
    <aside class="flex w-64 flex-col p-6 text-white shadow-lg" style="background-color: {{ $portal->branding_color }}">
        <nav class="flex flex-grow flex-col space-y-4">
            <!-- Logo -->
            <a href="{{ route('portal.show', ['portal' => $portal]) }}" class="mb-4 self-center" wire:navigate.hover>
                <img
                    src="{{ $logoPath ?? asset('portalEaseLogo.png') }}"
                    alt="{{ $portal->name ?? 'logo' }}"
                    class="max-h-12"
                />
            </a>

            <!-- Dashboard -->
            <a
                href="{{ route('portal.show', ['portal' => $portal]) }}"
                wire:navigate.hover
                class="flex items-center gap-2 text-xl font-bold focus-visible:outline focus-visible:outline-2 focus-visible:outline-white transition
                {{
                    request()->routeIs('portal.show')
                    ? 'border-l-4 border-white pl-3'
                    : 'pl-3 hover:border-l-4 hover:border-white'
                }}"
            >
                <x-lucide-layout-dashboard width="22" height="22" />
                Dashboard
            </a>

            @if (Auth::user()->hasRole('service_provider') || Auth::user()->hasRole('manager') || Auth::user()->hasRole('employee'))
                @if (Auth::user()->hasRole('service_provider') || Auth::user()->hasRole('manager'))
                    <!-- Users -->
                    <a
                        href="{{ route('portal.user.index', $portal) }}"
                        wire:navigate.hover
                        class="flex items-center gap-2 text-lg focus-visible:outline focus-visible:outline-2 focus-visible:outline-white transition
                    {{
                        request()->routeIs('portal.user.*')
                        ? 'border-l-4 border-white pl-3'
                        : 'pl-3 hover:border-l-4 hover:border-white'
                    }}"
                    >
                        <x-lucide-users width="22" height="22" />
                        Users
                    </a>
                @endif

                <!-- Invoices -->
                <a
                    href="{{ route('portal.invoice.index', $portal) }}"
                    wire:navigate.hover
                    class="flex items-center gap-2 text-lg focus-visible:outline focus-visible:outline-2 focus-visible:outline-white transition
                    {{
                        request()->routeIs('portal.invoice.*')
                        ? 'border-l-4 border-white pl-3'
                        : 'pl-3 hover:border-l-4 hover:border-white'
                    }}"
                >
                    <x-lucide-file-text width="22" height="22" />
                    Invoices
                </a>

                <!-- Projects -->
                <a
                    href="{{ route('portal.project.index', $portal) }}"
                    wire:navigate.hover
                    class="flex items-center gap-2 text-lg focus-visible:outline focus-visible:outline-2 focus-visible:outline-white transition
                    {{
                        request()->routeIs('portal.project.*')
                        ? 'border-l-4 border-white pl-3'
                        : 'pl-3 hover:border-l-4 hover:border-white'
                    }}"
                >
                    <x-lucide-briefcase width="22" height="22" />
                    Projects
                </a>

                <!-- Share files -->
                <a
                    href="{{ route('portal.file.create', $portal) }}"
                    wire:navigate.hover
                    class="flex items-center gap-2 text-lg focus-visible:outline focus-visible:outline-2 focus-visible:outline-white transition
                    {{
                        request()->routeIs('portal.file.create')
                        ? 'border-l-4 border-white pl-3'
                        : 'pl-3 hover:border-l-4 hover:border-white'
                    }}"
                >
                    <x-lucide-upload width="22" height="22" />
                    Share files/documents
                </a>

                <!-- Conversations -->
                <a
                    href="{{
                        route('portal.user.chat', [
                            'portal' => $portal,
                            'user' => \Illuminate\Support\Facades\Auth::user(),
                        ])
                    }}"
                    wire:navigate.hover
                    class="flex items-center gap-2 text-lg focus-visible:outline focus-visible:outline-2 focus-visible:outline-white transition
                    {{
                        request()->routeIs('portal.user.chat')
                        ? 'border-l-4 border-white pl-3'
                        : 'pl-3 hover:border-l-4 hover:border-white'
                    }}"
                >
                    <x-lucide-message-circle width="22" height="22" />
                    Conversations
                </a>
            @else
                <!-- Shared files -->
                <a
                    href="{{ route('portal.file.index', $portal) }}"
                    wire:navigate.hover
                    class="flex items-center gap-2 text-lg focus-visible:outline focus-visible:outline-2 focus-visible:outline-white transition
                    {{
                        request()->routeIs('portal.file.index')
                        ? 'border-l-4 border-white pl-3'
                        : 'pl-3 hover:border-l-4 hover:border-white'
                    }}"
                >
                    <x-lucide-folder width="22" height="22" />
                    Shared files/documents
                </a>

                <!-- Conversations -->
                <a
                    href="{{
                        route('portal.user.chat', [
                            'portal' => $portal,
                            'user' => \Illuminate\Support\Facades\Auth::user(),
                        ])
                    }}"
                    wire:navigate.hover
                    class="flex items-center gap-2 text-lg focus-visible:outline focus-visible:outline-2 focus-visible:outline-white transition
                    {{
                        request()->routeIs('portal.user.chat')
                        ? 'border-l-4 border-white pl-3'
                        : 'pl-3 hover:border-l-4 hover:border-white'
                    }}"
                >
                    <x-lucide-message-circle width="22" height="22" />
                    Conversations
                </a>

                <!-- Invoices -->
                @foreach ($portal->invoices as $invoice)
                    @if ($invoice->user->id === auth()->id())
                        <a
                            href="{{ route('portal.invoice.show', [$portal, $invoice]) }}"
                            wire:navigate.hover
                            class="flex items-center gap-2 pl-3 text-lg hover:border-l-4 hover:border-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-white"
                        >
                            <x-lucide-receipt width="22" height="22" />
                            Invoice: {{ $invoice->name }}
                        </a>
                    @endif
                @endforeach

                <!-- Projects -->
                @foreach ($portal->projects as $project)
                    @if ($project->customer->id === auth()->id())
                        <a
                            href="{{ route('portal.project.show', [$portal, $project]) }}?status=all"
                            wire:navigate.hover
                            class="flex items-center gap-2 pl-3 text-lg hover:border-l-4 hover:border-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-white"
                        >
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
            <a
                href="{{ route('logout.request') }}"
                wire:navigate.hover
                class="flex items-center justify-center gap-2 rounded-3xl bg-white py-2 text-center font-semibold text-blue-600 transition duration-200 hover:bg-gray-100"
            >
                <x-lucide-log-out width="22" height="22" />
                Logout
            </a>
        </div>
    </aside>

    <main class="flex-1 p-8">
        <div class="mx-auto max-w-5xl">
            <!-- Header tools -->
            <div class="mb-6 flex items-center justify-end space-x-4">
                <!-- Notifications -->
                <a
                    href="{{ route('portal.notification.index', $portal) }}"
                    wire:navigate.hover
                    aria-label="Notifications"
                    class="rounded transition focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-300"
                >
                    <x-lucide-bell width="22" height="22" class="text-black transition hover:text-gray-500" />
                </a>

                @if (Auth::user()->hasRole('service_provider'))
                    <!-- Settings -->
                    <a
                        href="{{ route('portal.edit', $portal) }}"
                        aria-label="Settings"
                        class="rounded transition focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-300"
                    >
                        <x-lucide-settings width="22" height="22" class="text-black transition hover:text-gray-500" />
                    </a>
                @endif

                <!-- Profile -->
                <a
                    href="{{
                        route('portal.user.edit', [
                            'portal' => $portal,
                            'user' => \Illuminate\Support\Facades\Auth::user(),
                        ])
                    }}"
                    aria-label="Profile"
                >
                    @if ($userLogoPath)
                        <img
                            src="{{ $userLogoPath }}"
                            alt="{{ auth()->user()->name }}"
                            class="h-8 w-8 rounded-full ring-2 ring-white transition focus-visible:ring-4 focus-visible:ring-blue-300"
                        />
                    @else
                        <img
                            src="{{ asset('anonymous_picture.jpg') }}"
                            alt="User profile photo"
                            class="h-8 w-8 rounded-full ring-2 ring-white transition focus-visible:ring-4 focus-visible:ring-blue-300"
                        />
                    @endif
                </a>
            </div>

            @livewireScripts

            <!-- Slot Content --> {{ $slot }}
        </div>
    </main>
</body>
</html>
