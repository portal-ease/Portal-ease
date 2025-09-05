<x-app-layout :portal="$portal">
    <h1 class="text-3xl font-bold text-blue-700 mb-6">Notifications</h1>

    @forelse(\Illuminate\Support\Facades\Auth::user()->notifications as $notification)
        <div class="bg-blue-100 border border-blue-300 text-blue-800 px-5 py-4 rounded-2xl shadow-sm mb-4">
            <div class="text-sm text-blue-600 mb-1">
                {{ $notification->created_at->diffForHumans() }}
            </div>
            {{ $notification->data['message'] }}
        </div>

    @empty
        <div class="bg-blue-50 border border-blue-200 text-blue-600 px-5 py-4 rounded-xl shadow-sm">
            You have no notifications at this time.
        </div>
    @endforelse
</x-app-layout>
