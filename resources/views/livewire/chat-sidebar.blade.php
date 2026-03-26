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
    <div class="flex flex-row gap-3 justify-between">
        <h2 class="text-xl font-bold pl-4 pb-4">Conversations</h2>
        <div x-data="{ open: false }">
            <!-- Trigger button -->
            <button @click="open = true" class="cursor-pointer">
                <h2 class="text-xl font-bold pb-4 pr-4">+</h2>
            </button>

            <!-- Teleported modal -->
            @teleport('body')
            <div
                    x-show="open"
                    x-transition.opacity.duration.200ms
                    @keydown.escape.window="open = false"
                    class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm"
            >
                <div
                        @click.outside="open = false"
                        x-transition.scale.duration.200ms
                        class="bg-white text-black rounded-2xl shadow-2xl w-full max-w-md p-6 relative"
                >
                    <!-- Close button -->
                    <button @click="open = false" class="absolute top-3 right-3 text-gray-600 hover:text-black">
                        &times;
                    </button>

                    <!-- Modal content -->
                    <h2 class="text-xl font-semibold mb-4">New Groupconversation</h2>

                    <form wire:submit.prevent="createConversation" class="space-y-4">
                        <p class="text-sm text-gray-600 mb-2">Select one or more users from your portal.</p>

                        <!-- Users List -->
                        <div class="max-h-64 overflow-y-auto border border-gray-200 rounded-lg p-3 space-y-2">
                            @forelse($portal->users as $user)
                                <label class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100 transition">
                                    <input
                                            type="checkbox"
                                            wire:model="selectedUsers"
                                            value="{{ $user->id }}"
                                            class="h-4 w-4 text-blue-600 rounded focus:ring-blue-500"
                                    >
                                    <div class="flex items-center space-x-3">
{{--                                        <img--}}
{{--                                                src="{{ $user->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($user->name) }}"--}}
{{--                                                alt="Avatar"--}}
{{--                                                class="h-8 w-8 rounded-full object-cover border border-gray-300"--}}
{{--                                        >--}}
                                        <span class="font-medium">{{ $user->name }}</span>
                                    </div>
                                </label>
                            @empty
                                <p class="text-gray-500 text-sm">No users found in this portal.</p>
                            @endforelse
                                <label for="name" class="block font-medium text-gray-700">Group Name</label>
                            <input type="text" name="name" wire:model="filedInTitle" value="{{ $filledInTitle }}" class="w-full border border-gray-300 rounded-md p-2 mt-1 focus:ring focus:ring-blue-200">
                        </div>

                        <!-- Buttons -->
                        <div class="flex justify-end pt-4">
                            <button type="button" @click="open = false"
                                    class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 mr-2">
                                Cancel
                            </button>
                            <button type="submit"
                                    class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50"> Create</button>
                        </div>
                    </form>

                </div>
            </div>
            @endteleport
        </div>

    </div>
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
