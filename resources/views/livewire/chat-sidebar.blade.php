<div class="w-80 text-white flex flex-col h-screen border-r-3 solid border-white overflow-hidden" style="background-color: {{ $portal->branding_color }}">
    <!-- 🔍 Search -->
    <div class="p-4">
        <div class="relative">
            <input
                type="text"
                placeholder="Search..."
                style="background-color: {{ $portal->branding_color }}"
                class="w-full pl-10 pr-4 py-2 rounded-full placeholder-gray-200 text-white outline-none ring-2 ring-white"
            >
            <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-3 top-2.5 h-5 w-5 text-white" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1016.65 16.65z"/>
            </svg>
        </div>
    </div>
    <h2 class="text-xl font-bold pl-4 pb-4">Conversations</h2>
    <!-- 📂 Tabs -->
    <div class="flex justify-around px-3 text-sm font-semibold mb-3">
        <button class="bg-black/20 px-3 py-1.5 rounded-full hover:bg-black/30 transition">All Chats</button>
        <button class="bg-black/20 px-3 py-1.5 rounded-full hover:bg-black/30 transition">Groups</button>
        <button class="bg-black/20 px-3 py-1.5 rounded-full hover:bg-black/30 transition">Contacts</button>
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
                    wire:click="conversationSelected({{ $conversation }})"
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
