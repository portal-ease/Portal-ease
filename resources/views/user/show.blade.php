<x-chat-layout :portal="currentPortal()">
    <div class="grid h-screen grid-cols-[0.5fr_1.5fr]">
        <livewire:chat-window :portal="currentPortal()" :conversation="$conversationP2p" />
        @if (auth()->user()->hasRole('service_provider'))
        <div class="h-min-content space-y-4 bg-white p-6 py-15">
            <div>
                <h3 class="text-sm font-semibold text-gray-500 uppercase">Email</h3>
                <p class="text-gray-700">{{ $user->email }}</p>
            </div>

            <div>
                <h3 class="text-sm font-semibold text-gray-500 uppercase">Joined</h3>
                <p class="text-gray-700">{{ $user->created_at->format('M d, Y') }}</p>
            </div>

            <div>
                <h3 class="text-sm font-semibold text-gray-500 uppercase">Status</h3>
                <span class="inline-flex rounded-full bg-green-100 px-3 py-1 text-xs text-green-700"> Active </span>
            </div>
            <div class="mt-8">
                <h3 class="mb-3 text-sm font-semibold text-gray-500 uppercase">Quick Actions</h3>

                <div class="space-y-2">
                    <a
                        href="{{ route('portal.user.edit', ['portal' => currentPortal(), 'user' => $user]) }}"
                        class="block w-full rounded-xl bg-yellow-500 py-2 text-center text-white hover:bg-yellow-600"
                    >
                        Edit Customer
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endif
</x-chat-layout>
