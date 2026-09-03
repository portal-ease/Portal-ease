@php
    use App\Services\FileStorageService;

    $logoPath = app(FileStorageService::class)->portalLogoUrl(currentPortal());
    $logoSrc = $logoPath ?? asset('portalEaseLogo.png');
@endphp
@if (\Illuminate\Support\Facades\Auth::user() && \Illuminate\Support\Facades\Auth::user()->portal == currentPortal())

    <x-app-layout :portal="currentPortal()">

        <div class="max-w-4xl mx-auto w-full px-4 sm:px-6 lg:px-0">

            @if (\Illuminate\Support\Facades\Auth::user()->hasRole('service_provider'))

                @if (\Illuminate\Support\Facades\Auth::user()->email_verified_at == null)
                    <!-- Email verification -->
                    <div
                        class="bg-red-600 rounded-xl shadow-md p-5 hover:shadow-lg transition flex items-center gap-3 mb-4">
                        <x-lucide-circle-alert class="text-red-400" width="22" height="22" />

                        <h2 class="text-lg font-semibold text-white">
                            Verify your email!!
                        </h2>

                        <a href="{{ route('portal.verify', currentPortal()) }}"
                            class="bg-green-300 rounded-xl p-4 text-lg font-semibold text-black">
                            Verify email
                        </a>
                    </div>
                @endif
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <!-- Customers -->
                    <a href="{{ route('portal.user.index', currentPortal()) }}"
                        class="bg-white rounded-xl shadow-md p-5 hover:shadow-lg transition flex items-center gap-3">
                        <x-lucide-users width="22" height="22" class="text-blue-500" />

                        <h2 class="text-lg font-semibold text-gray-700">
                            Portal Users: {{ count(currentPortal()->users) - 1 }}
                        </h2>
                    </a>

                    <!-- Projects -->
                    <a href="{{ route('portal.project.index', currentPortal()) }}"
                        class="bg-white rounded-xl shadow-md p-5 hover:shadow-lg transition flex items-center gap-3">
                        <x-lucide-briefcase width="22" height="22" class="text-green-500" />

                        <h2 class="text-lg font-semibold text-gray-700">
                            Projects: {{ count(currentPortal()->projects) }}
                        </h2>
                    </a>

                    <!-- Latest Messages -->
                    <a href="{{ route('portal.user.chat', ['portal' => currentPortal(), 'user' => $user]) }}"
                        class="bg-white rounded-xl shadow-md p-5 hover:shadow-lg transition flex flex-col gap-3 col-span-2">

                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <x-lucide-message-circle width="22" height="22" class="text-purple-500" />

                                <h2 class="text-lg font-semibold text-gray-700">
                                    Latest Messages
                                </h2>
                            </div>

                            <x-lucide-chevron-right width="20" height="20" class="text-gray-400" />
                        </div>

                        @forelse ($conversations as $conversation)
                            <div class="flex items-center gap-3 border-t border-gray-100 pt-3">

                                <div
                                    class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center shrink-0">
                                    @php
                                        $logoPath = app(FileStorageService::class)->userProfilePicture(
                                            $conversation->users->where('id', '!=', auth()->id())->first(),
                                        );
                                    @endphp
                                    <img src="{{ $logoPath ?? 'https://ui-avatars.com/api/?name=' . urlencode($user->name) }}"
                                        alt="Avatar"
                                        class="h-10 w-10 rounded-full object-cover border-2 border-[#007bff]">
                                </div>

                                <div class="min-w-0 flex-1">
                                    <p class="font-medium text-gray-800 truncate">
                                        {{ $conversation->users->where('id', '!=', auth()->id())->first()?->name ?? 'Unknown user' }}
                                    </p>

                                    <p class="text-sm text-gray-500 truncate">
                                        {{ $conversation->messages->last()?->message ?? 'No messages yet.' }}
                                    </p>
                                </div>

                                <span class="text-xs text-gray-400 whitespace-nowrap">
                                </span>
                            </div>
                        @empty
                            <div class="border-t border-gray-100 pt-4 text-sm text-gray-500">
                                No messages yet.
                            </div>
                        @endforelse

                    </a>

                </div>
            @else
                <!-- Welcome Card -->
                <div class="rounded-xl shadow-lg p-6 flex items-center gap-6 mt-4 text-white"
                    style="background-color: {{ $portal->branding_color }}">
                    <img src="{{ $logoSrc }}" alt="{{ currentPortal()->name }}"
                        class="w-20 h-20 rounded-full bg-white p-2">

                    <h1 class="text-3xl font-bold">
                        Welcome to {{ currentPortal()->name }}
                    </h1>
                </div>

                <!-- Portal Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">

                    <!-- Information Card -->
                    <div class="bg-white rounded-xl shadow-md p-6 flex flex-col gap-3 border border-blue-100">
                        <h2 class="text-xl font-semibold text-blue-700">
                            Information
                        </h2>

                        <p>
                            <span class="font-semibold text-gray-700">
                                Portal Name:
                            </span>
                            {{ currentPortal()->name }}
                        </p>

                        <p>
                            <span class="font-semibold text-gray-700">
                                Email:
                            </span>
                            {{ currentPortal()->email }}
                        </p>
                    </div>

                    <!-- Admins / Owners Card -->
                    <div class="bg-white rounded-xl shadow-md p-6 flex flex-col gap-3 border border-blue-100">
                        <h2 class="text-xl font-semibold text-blue-700">
                            Admins / Owners
                        </h2>

                        <div class="flex flex-wrap gap-2">

                            @foreach (currentPortal()->users as $user)
                                @if ($user->hasRole('service_provider'))
                                    <a href="{{ route('portal.user.show', [
                                        'portal' => currentPortal(),
                                        'user' => $user,
                                    ]) }}"
                                        class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-medium shadow-sm">
                                        {{ $user->name }}
                                    </a>
                                @endif
                            @endforeach

                        </div>
                    </div>

                </div>

            @endif

        </div>

    </x-app-layout>
@else
    <x-guestLayout>

        <!-- Login Card -->
        <div class="max-w-md mx-auto bg-white shadow-2xl rounded-2xl p-10 space-y-8 mt-12 mb-12">

            <!-- Logo -->
            <div class="flex justify-center">
                <img src="{{ $logoSrc }}" alt="{{ currentPortal()->name ?? 'logo' }}" class="max-h-14">
            </div>

            <!-- Title -->
            <h1 class="text-3xl font-extrabold text-center text-blue-900">
                {{ currentPortal()->name }} Login
            </h1>

            <p class="text-center text-gray-600 text-sm">
                Welcome back! Please sign in to continue.
            </p>

            @if (session('status'))
                <div class="mt-4 text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Form -->
            <form action="{{ route('login.request') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block font-medium text-gray-700">
                        Email address
                    </label>

                    <input type="email" id="email" name="email" required
                        class="w-full border border-gray-300 rounded-lg p-3 mt-1 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="you@example.com">

                    @error('email')
                        <div class="text-sm text-red-600 mt-1">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block font-medium text-gray-700">
                        Password
                    </label>

                    <input type="password" id="password" name="password" required
                        class="w-full border border-gray-300 rounded-lg p-3 mt-1 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        placeholder="••••••••">

                    @error('password')
                        <div class="text-sm text-red-600 mt-1">
                            {{ $message }}
                        </div>
                    @enderror

                    <a href="{{ route('password.request', currentPortal()) }}"
                       class="text-sm text-blue-600 hover:underline">
                        Forgot password?
                    </a>
                </div>

                <input type="hidden" name="portal_id" value="{{ $portal->id }}">

                <!-- Note -->
                <div
                    class="flex items-start gap-2 text-gray-500 text-sm bg-blue-50 border border-blue-100 p-3 rounded-lg">
                    <x-lucide-info width="22" height="22" class="text-blue-500 mt-0.5 shrink-0" />

                    <p>
                        You’re not yet a user of
                        <strong>{{ currentPortal()->name }}</strong>.
                        Ask the portal admin to create an account for you.
                    </p>
                </div>

                <!-- Login Button -->
                <button type="submit"
                    class="w-full bg-blue-600 text-white font-semibold py-3 px-6 rounded-xl shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300 transition">
                    Sign In
                </button>

            </form>

        </div>

    </x-guestLayout>

@endif
