@php use App\Services\FileStorageService @endphp
<div class="w-80 text-white flex flex-col h-screen border-r-3 solid border-white overflow-hidden"
    style="background-color: {{ $portal->branding_color }}">
    <div class="flex flex-row gap-3 justify-between mt-8">
        <h2 class="text-xl font-bold pl-4 pb-4">Conversations</h2>
    </div>
    <!-- 💬 Conversations List -->
    <div class="flex-1 overflow-y-auto space-y-3 px-3 pb-6">
        <!-- Conversation Item -->
        @forelse($conversations as $conversation)
            @php
                $otherUsers = $conversation->users->where('id', '!=', auth()->id());
                $lastMessage = $conversation->messages()->latest()->first();
            @endphp

            @foreach ($otherUsers as $user)
                @if (auth()->user()->hasRole('client'))
                    @if ($user->hasRole('client'))
                        @continue
                    @endif
                @endif
            @php
            $logoPath = app(FileStorageService::class)->userProfilePicture($user);
            @endphp
                <div wire:click="conversationSelected({{ $conversation }})" wire:navigate.hover
                    class="flex items-center bg-black/20 hover:bg-black/30 rounded-xl p-3 cursor-pointer transition relative">
                    <!-- Avatar -->
                    <img src="{{ $logoPath ?? 'https://ui-avatars.com/api/?name=' . urlencode($user->name) }}"
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
        @empty
            <h2 class="pl-4 pb-4">No conversations yet...</h2>
        @endforelse
    </div>

    <!-- 🌊 Bottom logo/button -->
    <div class="p-4 flex justify-end">
        <img src="{{ asset('portalEaseLogo.png') }}" alt="portalease" class="h-12 w-12">
    </div>
</div>
