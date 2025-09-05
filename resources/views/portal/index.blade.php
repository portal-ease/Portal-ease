<x-guestLayout>
    <div class="bg-white rounded-2xl p-8 flex flex-col gap-6 items-center shadow-2xl max-w-3xl mx-auto mt-10">
        <!-- Create Portal Button -->
        <a href="{{ route('portal.create') }}"
           class="bg-blue-600 hover:bg-blue-700 transition text-white text-sm font-medium px-5 py-3 rounded-xl shadow">
            ➕ Nieuwe Portal
        </a>

        <!-- Title -->
        <h2 class="text-2xl font-bold text-gray-900">Beschikbare Portals</h2>

        <!-- Portal Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 w-full">
            @forelse(\App\Models\Portal::all() as $portal)
                <a href="{{ route('portal.show', $portal) }}"
                   class="block bg-blue-50 hover:bg-blue-100 transition rounded-xl px-4 py-3 font-medium text-blue-800 shadow-sm">
                    {{ $portal->name }}
                </a>
            @empty
                <p class="text-gray-500 text-sm col-span-full text-center italic">Nog geen portals aangemaakt.</p>
            @endforelse
        </div>
    </div>
</x-guestLayout>
