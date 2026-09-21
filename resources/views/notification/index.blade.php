<x-app-layout :portal="currentPortal()">
    <h1 class="mb-6 text-3xl font-bold text-blue-700">Notifications</h1>

    @forelse (\Illuminate\Support\Facades\Auth::user()->notifications as $notification)
        <div class="mb-4 rounded-2xl border border-blue-300 bg-blue-100 px-5 py-4 text-blue-800 shadow-sm">
            <div class="mb-1 text-sm text-blue-600">{{ $notification->created_at->diffForHumans() }}</div>
            {{ $notification->data['message'] }}
        </div>

    @empty
        <div class="rounded-xl border border-blue-200 bg-blue-50 px-5 py-4 text-blue-600 shadow-sm">
            You have no notifications at this time.
        </div>
    @endforelse
</x-app-layout>
