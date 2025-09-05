@php
    $portalLogo = \App\Models\File::where('filename', $portal->name . '.jpg')->first();
@endphp
@if(\Illuminate\Support\Facades\Auth::user() && \Illuminate\Support\Facades\Auth::user()->portal == $portal)
    <x-app-layout :portal="$portal">
        <div class="max-w-4xl mx-auto w-full px-4 sm:px-6 lg:px-0">
            @if(\Illuminate\Support\Facades\Auth::user()->hasRole('service_provider'))
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <!-- Customers -->
                    <a href="{{ route('portal.user.index', $portal) }}"
                       class="bg-white rounded-xl shadow-md p-5 hover:shadow-lg transition flex items-center gap-3">
                        <x-heroicon-o-user-group class="w-6 h-6 text-blue-500"/>
                        <h2 class="text-lg font-semibold text-gray-700">Customers: {{ count($portal->users) - 1 }}</h2>
                    </a>

                    <!-- Projects -->
                    <a href="{{ route('portal.project.index' , $portal) }}"
                       class="bg-white rounded-xl shadow-md p-5 hover:shadow-lg transition flex items-center gap-3">
                        <x-heroicon-o-briefcase class="w-6 h-6 text-green-500"/>
                        <h2 class="text-lg font-semibold text-gray-700">Projects: {{ count($portal->projects) }}</h2>
                    </a>
                </div>
            @else
                <!-- Welcome Card -->
                <div
                    class=" rounded-xl shadow-lg p-6 flex items-center gap-6 mt-4 text-white" style="background-color: {{ $portal->branding_color }}">
                    <img src="{{ $portalLogo->url }}" alt="{{ $portalLogo->fileName }}"
                         class="w-20 h-20 rounded-full bg-white p-2">
                    <h1 class="text-3xl font-bold">Welcome to {{ $portal->name }}</h1>
                </div>

                <!-- Portal Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                    <!-- Information Card -->
                    <div class="bg-white rounded-xl shadow-md p-6 flex flex-col gap-3 border border-blue-100">
                        <h2 class="text-xl font-semibold text-blue-700">Information</h2>
                        <p><span class="font-semibold text-gray-700">Name:</span> {{ $portal->name }}</p>
                        <p><span class="font-semibold text-gray-700">Email:</span> {{ $portal->email }}</p>
                    </div>

                    <!-- Admins / Owners Card -->
                    <div class="bg-white rounded-xl shadow-md p-6 flex flex-col gap-3 border border-blue-100">
                        <h2 class="text-xl font-semibold text-blue-700">Admins / Owners</h2>
                        <div class="flex flex-wrap gap-2">
                            @foreach($portal->users as $user)
                                @if($user->hasRole('service_provider'))
                                    <a href="{{ route('portal.user.show', ["portal" => $portal , "user" => $user]) }}"
                                        class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-medium shadow-sm">
                                        {{ $user->name }}
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>

            @endif
            @if(\Illuminate\Support\Facades\Auth::user()->hasRole('service_provider'))
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Latest Messages -->
                    <div
                        class="bg-white rounded-xl shadow-md p-5 hover:shadow-lg transition flex flex-col gap-3">
                        <div class="flex flex-row gap-5">
                            <x-heroicon-o-chat-bubble-left-right class="w-6 h-6 text-pink-500"/>
                            <h2 class="text-lg font-semibold text-gray-700">Latest Messages</h2>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach($portal->chats as $chat)
                                @foreach($chat->messages->sortByDesc('created_at')->take(2)->reverse() as $message)
                                    <a href="{{ route('portal.chat.show', ['chat' => $chat, 'portal' => $portal]) }}"
                                       class="block">
                                        <div class="bg-blue-100 hover:bg-blue-200 transition rounded-xl p-4 shadow-sm">
                                            <div class="text-sm text-blue-700 font-semibold mb-1">
                                                {{ $message->user->name }}
                                            </div>
                                            <div class="text-gray-800 text-sm">
                                                {{ Str::limit($message->content, 50) }}
                                            </div>
                                            <div class="text-gray-500 text-xs text-right mt-2">
                                                {{ $message->created_at->format('H:i') }}
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            @endforeach
                        </div>

                    </div>
                </div>
            @endif
        </div>
    </x-app-layout>
@else
    <x-guestLayout>
        <div class="max-w-md mx-auto bg-white shadow-xl rounded-2xl p-8 space-y-6">
            <div class="w-full flex justify-center">
                <img src="{{ optional($portalLogo)->url ?? asset('portalEaseLogo.png') }}" alt="{{ $portalLogo->filename ?? "logo" }}" class="max-h-12">
            </div>
            <h1 class="text-2xl font-bold text-center">{{ $portal->name }} Login</h1>
            <form action="{{ route('login.request') }}" method="POST" class="space-y-4">
                @csrf
                <!-- Email -->
                <div>
                    <label for="email" class="block font-medium">Email address</label>
                    <input type="email" id="email" name="email" required
                           class="w-full border border-gray-300 rounded-md p-2 mt-1 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500">
                    @error('email')
                    <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block font-medium">Password</label>
                    <input type="password" id="password" name="password" required
                           class="w-full border border-gray-300 rounded-md p-2 mt-1 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500">
                    @error('password')
                    <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <input type="hidden" name="portal_id" value="{{ $portal->id }}">

                <!-- Note -->
                <div class="flex items-start gap-2 text-gray-500 text-sm">
                    <x-heroicon-o-information-circle class="h-5 w-5 mt-0.5"/>
                    <p>You’re not yet a user of <strong>{{ $portal->name }}</strong>. Ask the portal admin to create an
                        account for you.</p>
                </div>

                <button type="submit"
                        class="w-full bg-green-500 text-white p-3 rounded-xl hover:bg-blue-600 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-green-300">
                    Login
                </button>
            </form>
        </div>
    </x-guestLayout>
@endif
