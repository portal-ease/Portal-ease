<x-app-layout :portal="$portal">
    <div class="flex justify-end mb-6">
        @if($portal->subscription_status === "active")
            {{-- Active subscription: Always allow --}}
            <a href="{{ route('portal.user.create', ['portal' => $portal]) }}"
               class="inline-flex items-center bg-green-500 hover:bg-green-600 text-white text-sm font-medium py-2 px-4 rounded-2xl transition">
                + New Customer
            </a>
        @elseif(count($portal->users) < 3)
            {{-- No subscription, but fewer than 3 users: Allow --}}
            <a href="{{ route('portal.user.create', ['portal' => $portal]) }}"
               class="inline-flex items-center bg-green-500 hover:bg-green-600 text-white text-sm font-medium py-2 px-4 rounded-2xl transition">
                + New Customer
            </a>
        @else
            {{-- No subscription & already 3 users: Block --}}
            <p class="text-red-500 text-sm font-medium">
                You need a subscription to add more than 3 customers.
            </p>
        @endif
    </div>

    <div class="bg-white shadow-xl rounded-2xl p-6 md:p-8 space-y-6">
        <h2 class="text-2xl font-semibold text-gray-800">Customers</h2>

        @if($portal->users->count())
            <div class="divide-y divide-gray-200">
                @foreach($portal->users as $user)
                    @if($user->hasRole('client'))
                        <div class="flex flex-col md:flex-row md:items-center justify-between py-4 gap-3">
                            <a href="{{ route('portal.user.show', ['user' => $user, 'portal' => $portal]) }}"
                               class="text-lg text-gray-700 hover:underline">
                                {{ $user->name }}
                            </a>
                            <div>
                                <div class="flex gap-2">
                                    <a href="{{ route('portal.user.chat', ['portal' => $portal, 'user' => $user]) }}"
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
            <p class="text-gray-500 italic text-sm">
                There are currently no customers.
            </p>
        @endif
    </div>
</x-app-layout>

