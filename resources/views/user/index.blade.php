<x-app-layout :portal="$portal">
    <div class="flex justify-end mb-6">
        <a href="{{ route('portal.user.create', ['portal' => $portal]) }}"
           class="inline-flex items-center bg-green-500 hover:bg-green-600 text-white text-sm font-medium py-2 px-4 rounded-2xl transition">
            + New Customer
        </a>
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
                            <a href="{{ route('portal.user.edit', ['portal' => $portal, 'user' => $user]) }}"
                               class="inline-flex items-center bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium py-2 px-4 rounded-xl transition">
                                Edit Customer
                            </a>
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

