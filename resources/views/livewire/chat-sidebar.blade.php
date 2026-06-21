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
                </div>
            @endforeach
        @endforeach
    </div>

    <!-- 🌊 Bottom logo/button -->
    <div class="p-4 flex justify-end">
        <img src="{{ asset('portalEaseLogo.png') }}" alt="portalease" class="h-12 w-12">
    </div>
</div>
