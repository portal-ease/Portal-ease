<x-chat-layout :portal="$portal">
    <div class="grid grid-cols-[0.5fr_1.5fr] h-screen">
        <livewire:chat-window :portal="$portal" :conversation="$conversationP2p" />
        @if (auth()->user()->hasRole('service_provider'))
            <div class="bg-white h-min-content p-6 py-15 space-y-4">

                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">
                        Email
                    </h3>
                    <p class="text-gray-700">
                        {{ $user->email }}
                    </p>
                </div>

                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">
                        Joined
                    </h3>
                    <p class="text-gray-700">
                        {{ $user->created_at->format('M d, Y') }}
                    </p>
                </div>

                <div>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase">
                        Status
                    </h3>
                    <span class="inline-flex px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs">
                        Active
                    </span>
                </div>
                <div class="mt-8">
                    <h3 class="text-sm font-semibold text-gray-500 uppercase mb-3">
                        Quick Actions
                    </h3>

                    <div class="space-y-2">
                        <a href="{{ route('portal.user.edit', ['portal' => $portal, 'user' => $user]) }}"
                            class="block w-full text-center bg-yellow-500 hover:bg-yellow-600 text-white rounded-xl py-2">
                            Edit Customer
                        </a>
                    </div>
                </div>
            </div>
    </div>
    @endif
</x-chat-layout>
