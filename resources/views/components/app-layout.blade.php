@php
    $portalLogo = \App\Models\File::where('filename', $portal->name . '.jpg')->first();
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
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet"/>

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <link rel="icon" type="image/jpg" href="{{ optional($portalLogo)->url ?? asset('default_icon.jpg') }}">
</head>

<body class="bg-gray-100 text-[#1b1b18] min-h-screen flex font-sans">

<!-- Sidebar -->
<aside class="w-64 text-white p-6 flex flex-col shadow-lg" style="background-color: {{ $portal->branding_color }}">
    <nav class="flex flex-col space-y-4 flex-grow">
        <!-- Logo -->
        <a href="{{ route('portal.show', ['portal' => $portal]) }}" class="self-center mb-4">
            <img src="{{ optional($portalLogo)->url ?? asset('portalEaseLogo.png') }}"
                 alt="{{ $portalLogo->filename ?? "logo" }}" class="max-h-12">
        </a>

        <!-- Dashboard -->
        <a href="{{ route('portal.show', ['portal' => $portal]) }}"
           class="flex items-center gap-2 text-xl font-bold focus-visible:outline focus-visible:outline-2 focus-visible:outline-white transition
           {{ request()->routeIs('portal.show') ? 'border-l-4 border-white pl-3' : 'pl-3 hover:border-l-4 hover:border-white' }}">
            <svg class="w-5 h-5">
                <use href="#icon-home"/>
            </svg>
            Dashboard
        </a>

        @if(Auth::user()->hasRole('service_provider'))
            <a href="{{ route('portal.user.index', $portal) }}"
               class="flex items-center gap-2 text-lg focus-visible:outline focus-visible:outline-2 focus-visible:outline-white transition
               {{ request()->routeIs('portal.user.*') ? 'border-l-4 border-white pl-3' : 'pl-3 hover:border-l-4 hover:border-white' }}">
                <svg class="w-5 h-5">
                    <use href="#icon-users"/>
                </svg>

                Customers
            </a>

            <a href="{{ route('portal.invoice.index', $portal) }}"
               class="flex items-center gap-2 text-lg focus-visible:outline focus-visible:outline-2 focus-visible:outline-white transition
               {{ request()->routeIs('portal.invoice.*') ? 'border-l-4 border-white pl-3' : 'pl-3 hover:border-l-4 hover:border-white' }}">
                <svg class="w-5 h-5">
                    <use href="#icon-document-text"/>
                </svg>
                Invoices
            </a>

            <a href="{{ route('portal.chat.index', $portal) }}"
               class="flex items-center gap-2 text-lg focus-visible:outline focus-visible:outline-2 focus-visible:outline-white transition
               {{ request()->routeIs('portal.chat.*') ? 'border-l-4 border-white pl-3' : 'pl-3 hover:border-l-4 hover:border-white' }}">
                <svg class="w-5 h-5">
                    <use href="#icon-chat"/>
                </svg>
                Chats
            </a>

            <a href="{{ route('portal.project.index', $portal) }}"
               class="flex items-center gap-2 text-lg focus-visible:outline focus-visible:outline-2 focus-visible:outline-white transition
               {{ request()->routeIs('portal.project.*') ? 'border-l-4 border-white pl-3' : 'pl-3 hover:border-l-4 hover:border-white' }}">
                <svg class="w-5 h-5">
                    <use href="#icon-briefcase"/>
                </svg>
                Projects
            </a>

            <a href="{{ route('portal.file.create', $portal) }}"
               class="flex items-center gap-2 text-lg focus-visible:outline focus-visible:outline-2 focus-visible:outline-white transition
               {{ request()->routeIs('portal.file.create') ? 'border-l-4 border-white pl-3' : 'pl-3 hover:border-l-4 hover:border-white' }}">
                <svg class="w-5 h-5">
                    <use href="#icon-upload"/>
                </svg>
                Share files/documents
            </a>

        @else
            <a href="{{ route('portal.file.index', $portal) }}"
               class="flex items-center gap-2 text-lg focus-visible:outline focus-visible:outline-2 focus-visible:outline-white transition
               {{ request()->routeIs('portal.file.index') ? 'border-l-4 border-white pl-3' : 'pl-3 hover:border-l-4 hover:border-white' }}">
                <svg class="w-5 h-5">
                    <use href="#icon-folder"/>
                </svg>
                Shared files/documents
            </a>

            @foreach($portal->invoices as $invoice)
                @if($invoice->user->id === auth()->id())
                    <a href="{{ route('portal.invoice.show', [$portal, $invoice]) }}"
                       class="text-lg pl-3 hover:border-l-4 hover:border-white flex items-center gap-2 focus-visible:outline focus-visible:outline-2 focus-visible:outline-white">
                        <svg class="w-5 h-5">
                            <use href="#icon-receipt"/>
                        </svg>
                        Invoice: {{ $invoice->name }}
                    </a>
                @endif
            @endforeach

            @foreach($portal->projects as $project)
                @if($project->customer->id === auth()->id())
                    <a href="{{ route('portal.project.show', [$portal, $project]) }}?status=all"
                       class="text-lg pl-3 hover:border-l-4 hover:border-white flex items-center gap-2 focus-visible:outline focus-visible:outline-2 focus-visible:outline-white">
                        <svg class="w-5 h-5">
                            <use href="#icon-clipboard"/>
                        </svg>
                        Project: {{ $project->name }}
                    </a>
                @endif
            @endforeach

            @foreach($portal->chats as $chat)
                @if($chat->user1->id === auth()->id())
                    <a href="{{ route('portal.chat.show', [$portal, $chat]) }}"
                       class="text-lg pl-3 hover:border-l-4 hover:border-white flex items-center gap-2 focus-visible:outline focus-visible:outline-2 focus-visible:outline-white">
                        <svg class="w-5 h-5">
                            <use href="#icon-chat-ellipsis"/>
                        </svg>
                        Chat
                    </a>
                @endif
            @endforeach
        @endif
        @if(Auth::user()->role == "service_provider")
            <a href="{{ route('portal.edit', $portal) }}"
               class="flex items-center gap-2 text-lg focus-visible:outline focus-visible:outline-2 focus-visible:outline-white transition
               {{ request()->routeIs('portal.edit') ? 'border-l-4 border-white pl-3' : 'pl-3 hover:border-l-4 hover:border-white' }}">
                <img class="w-5 h-5" alt="logo" src="{{ asset('portalEaseLogo.png') }}"/>
                Portal
            </a>
        @endif
    </nav>

    <!-- Logout Button -->
    <div class="mt-6">
        <a href="{{ route('logout.request') }}"
           class="block bg-white hover:bg-gray-100 text-blue-600 font-semibold text-center py-2 rounded-3xl transition duration-200">
            Logout
        </a>
    </div>
</aside>


<main class="flex-1 p-8">
    <div class="max-w-5xl mx-auto">
        <!-- Header tools -->
        <div class="flex justify-end items-center space-x-4 mb-6">
            <!-- Bell Icon -->
            <a href="{{ route('portal.notification.index', $portal) }}" type="button"
               class="focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-300 rounded transition">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-black hover:text-gray-300">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0"/>
                </svg>
            </a>

            <!-- Settings Icon -->
            <a href="{{ route('portal.user.edit', ["portal" => $portal, "user" => \Illuminate\Support\Facades\Auth::user()]) }}"
               type="button"
               class="focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-300 rounded transition">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-black hover:text-gray-300">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z"/>
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                </svg>
            </a>

            <!-- Profile Image -->
            <a href="{{ route('portal.user.show', ["portal" => $portal, "user" => \Illuminate\Support\Facades\Auth::user()]) }}">
                @php
                    $user = \Illuminate\Support\Facades\Auth::user();
                    $baseName = $user->name . $user->id;
                    $file = \App\Models\File::whereIn('filename', [
                        $baseName . '.jpg',
                        $baseName . '.png',
                        $baseName . '.jpeg',
                    ])->first();
                @endphp

                @if($file)
                    <img src="{{ $file->url }}" alt="{{ $file->filename }}"
                         class="w-8 h-8 rounded-full ring-2 ring-white focus-visible:ring-4 focus-visible:ring-blue-300 transition">
                @else
                    <img src="{{ asset('anonymous_picture.jpg') }}" alt="User profile photo"
                         class="w-8 h-8 rounded-full ring-2 ring-white focus-visible:ring-4 focus-visible:ring-blue-300 transition">
                @endif
            </a>
        </div>

        <!-- Slot Content -->
        {{ $slot }}
        @include('components.icons')
    </div>
</main>

</body>
</html>
