@php
    use App\Services\FileStorageService;

    $logoPath = app(FileStorageService::class)->portalLogoUrl(currentPortal());
    $logoSrc = $logoPath ?? asset('portalEaseLogo.png');
@endphp
@if (\Illuminate\Support\Facades\Auth::user() && \Illuminate\Support\Facades\Auth::user()->portal == currentPortal())
    <x-app-layout :portal="currentPortal()">
        <div class="mx-auto w-full max-w-4xl px-4 sm:px-6 lg:px-0">
            @if (Auth::user()->hasRole('service_provider') || Auth::user()->hasRole('manager') || Auth::user()->hasRole('employee'))
                @if (\Illuminate\Support\Facades\Auth::user()->email_verified_at == null)
                    <!-- Email verification -->
                    <div class="mb-4 flex items-center gap-3 rounded-xl bg-red-600 p-5 shadow-md transition hover:shadow-lg">
                        <x-lucide-circle-alert class="text-red-400" width="22" height="22" />

                        <h2 class="text-lg font-semibold text-white">Verify your email!!</h2>

                        <a
                            href="{{ route('portal.verify', currentPortal()) }}"
                            class="rounded-xl bg-green-300 p-4 text-lg font-semibold text-black"
                        >
                            Verify email
                        </a>
                    </div>
                @endif
                <div class="mb-4 grid grid-cols-2 gap-4">
                    @if (auth()->user()->hasRole('service_provider'))
                        <!-- Customers -->
                        <a
                            href="{{ route('portal.user.index', currentPortal()) }}"
                            class="flex items-center gap-3 rounded-xl bg-white p-5 shadow-md transition hover:shadow-lg"
                        >
                            <x-lucide-users width="22" height="22" class="text-blue-500" />

                            <h2 class="text-lg font-semibold text-gray-700">
                                Portal Users: {{ count(currentPortal()->users) }}
                            </h2>
                        </a>
                    @endif

                    <!-- Projects -->
                    <a
                        href="{{ route('portal.project.index', currentPortal()) }}"
                        class="flex items-center gap-3 rounded-xl bg-white p-5 shadow-md transition hover:shadow-lg"
                    >
                        <x-lucide-briefcase width="22" height="22" class="text-green-500" />

                        <h2 class="text-lg font-semibold text-gray-700">
                            Projects: {{ count(currentPortal()->projects) }}
                        </h2>
                    </a>

                    <!-- Latest Messages -->
                    <a
                        href="{{ route('portal.user.chat', ['portal' => currentPortal(), 'user' => $user]) }}"
                        class="col-span-2 flex flex-col gap-3 rounded-xl bg-white p-5 shadow-md transition hover:shadow-lg"
                    >
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <x-lucide-message-circle width="22" height="22" class="text-purple-500" />

                                <h2 class="text-lg font-semibold text-gray-700">Latest Messages</h2>
                            </div>

                            <x-lucide-chevron-right width="20" height="20" class="text-gray-400" />
                        </div>

                        @forelse ($conversations as $conversation)
                            <div class="flex items-center gap-3 border-t border-gray-100 pt-3">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-purple-100">
                                    @php
                                        $logoPath = app(FileStorageService::class)->userProfilePicture(
                                            $conversation->users->where('id', '!=', auth()->id())->first(),
                                        );
                                    @endphp
                                    <img
                                        src="{{ $logoPath ?? 'https://ui-avatars.com/api/?name=' . urlencode($user->name) }}"
                                        alt="Avatar"
                                        class="h-10 w-10 rounded-full border-2 border-[#007bff] object-cover"
                                    />
                                </div>

                                <div class="min-w-0 flex-1">
                                    <p class="truncate font-medium text-gray-800">
                                        {{ $conversation->users->where('id', '!=', auth()->id())->first()?->name ?? 'Unknown user' }}
                                    </p>

                                    <p class="truncate text-sm text-gray-500">
                                        {{ $conversation->messages->last()?->message ?? 'No messages yet.' }}
                                    </p>
                                </div>

                                <span class="text-xs whitespace-nowrap text-gray-400"> </span>
                            </div>
                        @empty
                            <div class="border-t border-gray-100 pt-4 text-sm text-gray-500">No messages yet.</div>
                        @endforelse
                    </a>
                </div>
            @else
                <!-- Welcome Card -->
                <div
                    class="mt-4 flex items-center gap-6 rounded-xl p-6 text-white shadow-lg"
                    style="background-color: {{ $portal->branding_color }}"
                >
                    <img
                        src="{{ $logoSrc }}"
                        alt="{{ currentPortal()->name }}"
                        class="h-20 w-20 rounded-full bg-white p-2"
                    />

                    <h1 class="text-3xl font-bold">Welcome to {{ currentPortal()->name }}</h1>
                </div>

                <!-- Portal Info -->
                <div class="mt-6 grid grid-cols-1 gap-6 md:grid-cols-2">
                    <!-- Information Card -->
                    <div class="flex flex-col gap-3 rounded-xl border border-blue-100 bg-white p-6 shadow-md">
                        <h2 class="text-xl font-semibold text-blue-700">Information</h2>

                        <p>
                            <span class="font-semibold text-gray-700"> Portal Name: </span>
                            {{ currentPortal()->name }}
                        </p>

                        <p>
                            <span class="font-semibold text-gray-700"> Email: </span>
                            {{ currentPortal()->email }}
                        </p>
                    </div>

                    <!-- Admins / Owners Card -->
                    <div class="flex flex-col gap-3 rounded-xl border border-blue-100 bg-white p-6 shadow-md">
                        <h2 class="text-xl font-semibold text-blue-700">Admins / Owners</h2>

                        <div class="flex flex-wrap gap-2">
                            @foreach (currentPortal()->users as $user)
                                @if ($user->hasRole('service_provider'))
                                    <a
                                        href="{{
                                            route('portal.user.show', [
                                                'portal' => currentPortal(),
                                                'user' => $user,
                                            ])
                                        }}"
                                        class="rounded-full bg-blue-100 px-3 py-1 text-sm font-medium text-blue-700 shadow-sm"
                                    >
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
        <div class="mx-auto mt-12 mb-12 max-w-md space-y-8 rounded-2xl bg-white p-10 shadow-2xl">
            <!-- Logo -->
            <div class="flex justify-center">
                <img src="{{ $logoSrc }}" alt="{{ currentPortal()->name ?? 'logo' }}" class="max-h-14" />
            </div>

            <!-- Title -->
            <h1 class="text-center text-3xl font-extrabold text-blue-900">{{ currentPortal()->name }} Login</h1>

            <p class="text-center text-sm text-gray-600">Welcome back! Please sign in to continue.</p>

            @if (session('status'))
                <div class="mt-4 text-green-600">{{ session('status') }}</div>
            @endif

            <!-- Form -->
            <form action="{{ route('login.request') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block font-medium text-gray-700"> Email address </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        required
                        class="mt-1 w-full rounded-lg border border-gray-300 p-3 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        placeholder="you@example.com"
                    />

                    @error('email')
                        <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block font-medium text-gray-700"> Password </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        required
                        class="mt-1 w-full rounded-lg border border-gray-300 p-3 shadow-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:outline-none"
                        placeholder="••••••••"
                    />

                    @error('password')
                        <div class="mt-1 text-sm text-red-600">{{ $message }}</div>
                    @enderror

                    <a
                        href="{{ route('password.request', currentPortal()) }}"
                        class="text-sm text-blue-600 hover:underline"
                    >
                        Forgot password?
                    </a>
                </div>

                <input type="hidden" name="portal_id" value="{{ $portal->id }}" />

                <!-- Note -->
                <div class="flex items-start gap-2 rounded-lg border border-blue-100 bg-blue-50 p-3 text-sm text-gray-500">
                    <x-lucide-info width="22" height="22" class="mt-0.5 shrink-0 text-blue-500" />

                    <p>
                        You’re not yet a user of
                        <strong>{{ currentPortal()->name }}</strong>. Ask the portal admin to create an account for you.
                    </p>
                </div>

                <!-- Login Button -->
                <button
                    type="submit"
                    class="w-full rounded-xl bg-blue-600 px-6 py-3 font-semibold text-white shadow-md transition hover:bg-blue-700 focus:ring-2 focus:ring-blue-300 focus:outline-none"
                >
                    Sign In
                </button>
            </form>
        </div>
    </x-guestLayout>

@endif
