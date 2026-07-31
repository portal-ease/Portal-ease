@php
    use Illuminate\Support\Facades\Storage;
@endphp
@php
    $logoPath = null;

    if (Storage::disk('public')->exists('profile-pictures/' . $portal->name . '.jpg')) {
        $logoPath = Storage::url('profile-pictures/' . $portal->name . '.jpg');
    } elseif (Storage::disk('public')->exists('profile-pictures/' . $portal->name . '.png')) {
        $logoPath = Storage::url('profile-pictures/' . $portal->name . '.png');
    }
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

    <link rel="icon" type="image/png" href="{{ $logoPath ?? asset('default_icon.jpg') }}">
</head>

<body class="bg-gray-100 text-[#1b1b18] min-h-screen flex font-sans">
    <!-- Sidebar -->
    <aside class="w-64 text-white p-6 flex flex-col shadow-lg sm"
        style="background-color: {{ $portal->branding_color }}">
        <nav class="flex flex-col space-y-4 flex-grow">
            <!-- Logo -->
            <a href="{{ route('portal.show', ['portal' => $portal]) }}" class="self-center mb-4" wire:navigate.hover>
                <img src="{{ $logoPath ?? asset('portalEaseLogo.png') }}" alt="{{ $portal->name ?? 'logo' }}"
                    class="max-h-12">
            </a>

            <!-- Dashboard -->
            <a href="{{ route('portal.show', ['portal' => $portal]) }}" wire:navigate.hover
                class="flex items-center gap-2 text-xl font-bold focus-visible:outline focus-visible:outline-2 focus-visible:outline-white transition
           {{ request()->routeIs('portal.show') ? 'border-l-4 border-white pl-3' : 'pl-3 hover:border-l-4 hover:border-white' }}">
                <svg class="w-5 h-5">
                    <use href="#icon-home" />
                </svg>
                Dashboard
            </a>

            @if (Auth::user()->hasRole('service_provider'))
                <a href="{{ route('portal.user.index', $portal) }}" wire:navigate.hover
                    class="flex items-center gap-2 text-lg focus-visible:outline focus-visible:outline-2 focus-visible:outline-white transition
               {{ request()->routeIs('portal.user.*') ? 'border-l-4 border-white pl-3' : 'pl-3 hover:border-l-4 hover:border-white' }}">
                    <svg class="w-5 h-5">
                        <use href="#icon-users" />
                    </svg>

                    Customers
                </a>

                <a href="{{ route('portal.invoice.index', $portal) }}" wire:navigate.hover
                    class="flex items-center gap-2 text-lg focus-visible:outline focus-visible:outline-2 focus-visible:outline-white transition
               {{ request()->routeIs('portal.invoice.*') ? 'border-l-4 border-white pl-3' : 'pl-3 hover:border-l-4 hover:border-white' }}">
                    <svg class="w-5 h-5">
                        <use href="#icon-document-text" />
                    </svg>
                    Invoices
                </a>
                <a href="{{ route('portal.project.index', $portal) }}" wire:navigate.hover
                    class="flex items-center gap-2 text-lg focus-visible:outline focus-visible:outline-2 focus-visible:outline-white transition
               {{ request()->routeIs('portal.project.*') ? 'border-l-4 border-white pl-3' : 'pl-3 hover:border-l-4 hover:border-white' }}">
                    <svg class="w-5 h-5">
                        <use href="#icon-briefcase" />
                    </svg>
                    Projects
                </a>

                <a href="{{ route('portal.file.create', $portal) }}" wire:navigate.hover
                    class="flex items-center gap-2 text-lg focus-visible:outline focus-visible:outline-2 focus-visible:outline-white transition
               {{ request()->routeIs('portal.file.create') ? 'border-l-4 border-white pl-3' : 'pl-3 hover:border-l-4 hover:border-white' }}">
                    <svg class="w-5 h-5">
                        <use href="#icon-upload" />
                    </svg>
                    Share files/documents
                </a>
                <a href="{{ route('portal.user.chat', ['portal' => $portal, 'user' => \Illuminate\Support\Facades\Auth::user()]) }}"
                    wire:navigate.hover
                    class="flex items-center gap-2 text-lg focus-visible:outline focus-visible:outline-2 focus-visible:outline-white transition
               {{ request()->routeIs('portal.user.chat') ? 'border-l-4 border-white pl-3' : 'pl-3 hover:border-l-4 hover:border-white' }}">
                    <svg class="w-5 h-5">
                        <use href="#icon-chat-ellipsis" />
                    </svg>
                    Conversations
                </a>
            @else
                <a href="{{ route('portal.file.index', $portal) }}" wire:navigate.hover
                    class="flex items-center gap-2 text-lg focus-visible:outline focus-visible:outline-2 focus-visible:outline-white transition
               {{ request()->routeIs('portal.file.index') ? 'border-l-4 border-white pl-3' : 'pl-3 hover:border-l-4 hover:border-white' }}">
                    <svg class="w-5 h-5">
                        <use href="#icon-folder" />
                    </svg>
                    Shared files/documents
                </a>
                <a href="{{ route('portal.user.chat', ['portal' => $portal, 'user' => \Illuminate\Support\Facades\Auth::user()]) }}"
                    wire:navigate.hover
                    class="flex items-center gap-2 text-lg focus-visible:outline focus-visible:outline-2 focus-visible:outline-white transition
               {{ request()->routeIs('portal.user.chat') ? 'border-l-4 border-white pl-3' : 'pl-3 hover:border-l-4 hover:border-white' }}">
                    <svg class="w-5 h-5">
                        <use href="#icon-chat-ellipsis" />
                    </svg>
                    Conversations
                </a>

                @foreach ($portal->invoices as $invoice)
                    @if ($invoice->user->id === auth()->id())
                        <a href="{{ route('portal.invoice.show', [$portal, $invoice]) }}" wire:navigate.hover
                            class="text-lg pl-3 hover:border-l-4 hover:border-white flex items-center gap-2 focus-visible:outline focus-visible:outline-2 focus-visible:outline-white">
                            <svg class="w-5 h-5">
                                <use href="#icon-receipt" />
                            </svg>
                            Invoice: {{ $invoice->name }}
                        </a>
                    @endif
                @endforeach

                @foreach ($portal->projects as $project)
                    @if ($project->customer->id === auth()->id())
                        <a href="{{ route('portal.project.show', [$portal, $project]) }}?status=all"
                            wire:navigate.hover
                            class="text-lg pl-3 hover:border-l-4 hover:border-white flex items-center gap-2 focus-visible:outline focus-visible:outline-2 focus-visible:outline-white">
                            <svg class="w-5 h-5">
                                <use href="#icon-clipboard" />
                            </svg>
                            Project: {{ $project->name }}
                        </a>
                    @endif
                @endforeach
            @endif
        </nav>

        <!-- Logout Button -->
        <div class="mt-6">
            <a href="{{ route('logout.request') }}" wire:navigate.hover
                class="block bg-white hover:bg-gray-100 text-blue-600 font-semibold text-center py-2 rounded-3xl transition duration-200">
                Logout
            </a>
        </div>
    </aside>
    @livewireScripts


    <main>
        <div class=" mx-auto">
            <!-- Slot Content -->
            {{ $slot }}
            @include('components.icons')
        </div>
    </main>

</body>

</html>
