<x-app-layout :portal="$portal">
    <div class="max-w-6xl mx-auto">

        {{-- Header --}}
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Customers</h1>
                <p class="text-gray-500 text-sm">
                    Manage your customer accounts.
                </p>
            </div>

            @if($portal->subscription_status === "active" || $portal->users->count() < 3)
                <a href="{{ route('portal.user.create', ['portal' => $portal]) }}"
                   class="inline-flex items-center gap-2 bg-green-500 hover:bg-green-600 text-white px-5 py-3 rounded-xl shadow transition">
                    <i class="fa-solid fa-plus"></i>
                    New Customer
                </a>
            @endif
        </div>
        @if($portal->users->where(fn($u) => $u->hasRole('client'))->count())
            <div class="grid gap-4">
                @foreach($portal->users as $user)
                    @if($user->hasRole('client'))
                        <div class="bg-white rounded-2xl shadow-sm hover:shadow-md transition p-5">
                            <div class="flex items-center justify-between">

                                <div class="flex items-center gap-4">
                                    <div class="h-12 w-12 rounded-full bg-gray-200 flex items-center justify-center font-semibold text-gray-700">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>

                                    <div>
                                        <a href="{{ route('portal.user.show', ['user' => $user, 'portal' => $portal]) }}"
                                           class="font-semibold text-lg text-gray-800 hover:text-blue-600">
                                            {{ $user->name }}
                                        </a>

                                        <p class="text-sm text-gray-500">
                                            Customer
                                        </p>
                                    </div>
                                </div>

                                <div class="flex items-center gap-2">
                                    <a href="{{ route('portal.user.show', ['portal' => $portal, 'user' => $user]) }}"
                                       class="inline-flex items-center gap-2 bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium py-2 px-4 rounded-xl transition">
                                        Chat
                                    </a>

                                    <a href="{{ route('portal.user.edit', ['portal' => $portal, 'user' => $user]) }}"
                                       class="inline-flex items-center gap-2 bg-yellow-500 hover:bg-yellow-600 text-white text-sm font-medium py-2 px-4 rounded-xl transition">
                                        Edit
                                    </a>
                                </div>

                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-2xl shadow-sm p-10 text-center">
                <i class="fa-solid fa-users text-4xl text-gray-300 mb-4"></i>
                <p class="text-gray-500">
                    No customers found.
                </p>
            </div>
        @endif
    </div>
</x-app-layout>
