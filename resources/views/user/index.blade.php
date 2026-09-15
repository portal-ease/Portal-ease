<x-app-layout :portal="currentPortal()">
    <div class="mx-auto max-w-6xl">
        {{-- Header --}}
        <div class="mb-6 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Users</h1>
                <p class="text-sm text-gray-500">Manage your user accounts.</p>
            </div>

            <a
                href="{{ route('portal.user.create', ['portal' => currentPortal()]) }}"
                class="inline-flex items-center gap-2 rounded-xl bg-green-500 px-5 py-3 text-white shadow transition hover:bg-green-600"
            >
                <i class="fa-solid fa-plus"></i>
                New User
            </a>
        </div>
        @if (currentPortal()->users)
            <div class="grid gap-4">
                @foreach (currentPortal()->users as $user)
                    @if($user->id === auth()->id())
                        @continue
                    @endif
                    <div class="rounded-2xl bg-white p-5 shadow-sm transition hover:shadow-md">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div
                                    class="flex h-12 w-12 items-center justify-center rounded-full bg-gray-200 font-semibold text-gray-700">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>

                                <div>
                                    <a
                                        href="{{ route('portal.user.show', ['user' => $user, 'portal' => currentPortal()]) }}"
                                        class="text-lg font-semibold text-gray-800 hover:text-blue-600"
                                    >
                                        {{ $user->name }}
                                    </a>

                                    <p class="text-sm text-gray-500">{{ $user->getRoleNames()->first() }}</p>
                                </div>
                            </div>

                            <div class="flex items-center gap-2">
                                <a
                                    href="{{ route('portal.user.show', ['portal' => currentPortal(), 'user' => $user]) }}"
                                    class="inline-flex items-center gap-2 rounded-xl bg-blue-500 px-4 py-2 text-sm font-medium text-white transition hover:bg-blue-600"
                                >
                                    Chat
                                </a>

                                <a
                                    href="{{ route('portal.user.edit', ['portal' => currentPortal(), 'user' => $user]) }}"
                                    class="inline-flex items-center gap-2 rounded-xl bg-yellow-500 px-4 py-2 text-sm font-medium text-white transition hover:bg-yellow-600"
                                >
                                    Edit
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="rounded-2xl bg-white p-10 text-center shadow-sm">
                <i class="fa-solid fa-users mb-4 text-4xl text-gray-300"></i>
                <p class="text-gray-500">No users found.</p>
            </div>
        @endif
    </div>
</x-app-layout>
