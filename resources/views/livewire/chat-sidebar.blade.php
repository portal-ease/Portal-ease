<div class="w-80 text-white flex flex-col h-screen border-r-3 solid border-white overflow-hidden" style="background-color: {{ $portal->branding_color }}">
    <div class="flex flex-row gap-3 justify-between mt-8">
        <h2 class="text-xl font-bold pl-4 pb-4">Conversations</h2>
    </div>
    <!-- 💬 Conversations List -->
    <div class="flex-1 overflow-y-auto space-y-3 px-3 pb-6">
        <!-- Conversation Item -->
        @foreach($conversations as $conversation)
            @php
                $otherUsers = $conversation->users->where('id', '!=', auth()->id());
                $lastMessage = $conversation->messages()->latest()->first();
            @endphp

            @foreach($otherUsers as $user)
                <div
                    wire:click="conversationSelected({{ $conversation }})" wire:navigate
                    class="flex items-center bg-black/20 hover:bg-black/30 rounded-xl p-3 cursor-pointer transition relative"
                >
                    <!-- Avatar -->
                    <img src="{{ $user->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($user->name) }}"
                         alt="Avatar" class="h-10 w-10 rounded-full object-cover border-2 border-[#007bff]">

                    <!-- Info -->
                    <div class="ml-3 flex-1">
                        <div class="font-semibold">{{ $user->name }}</div>
                        <div class="text-sm text-gray-300 truncate">
                            {{ $lastMessage?->message ?? 'No messages yet' }}
                        </div>
                    </div>

                    <!-- Status dot -->
                    <div
                        class="absolute top-3 left-8 w-3 h-3 rounded-full bg-green-500 border-2 border-[#2e2e2e]"></div>

                    <!-- Unread badge (voorbeeld) -->
                    @if($conversation->unread_count ?? false)
                        <div class="bg-green-500 text-white text-xs rounded-full px-2 py-0.5">
                            {{ $conversation->unread_count }}
                        </div>
                    @endif
                </div>
            @endforeach
        @endforeach
    </div>

    <!-- 🌊 Bottom logo/button -->
    <div class="p-4 flex justify-end">
        <img src="{{ asset('portalEaseLogo.png') }}" alt="portalease" class="h-12 w-12">
    </div>
</div>
