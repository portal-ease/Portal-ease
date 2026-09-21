@php use App\Services\FileStorageService @endphp
<div
    class="solid flex h-screen w-80 flex-col overflow-hidden border-r-3 border-white text-white"
    style="background-color: {{ $portal->branding_color }}"
>
    <div class="mt-8 flex flex-row justify-between gap-3">
        <h2 class="pb-4 pl-4 text-xl font-bold">Conversations</h2>
    </div>
    <!-- 💬 Conversations List -->
    <div class="flex-1 space-y-3 overflow-y-auto px-3 pb-6">
        <!-- Conversation Item -->
        @forelse ($conversations as $conversation)
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
                <div
                    wire:click="conversationSelected({{ $conversation }})"
                    wire:navigate.hover
                    class="relative flex cursor-pointer items-center rounded-xl bg-black/20 p-3 transition hover:bg-black/30"
                >
                    <!-- Avatar -->
                    <img
                        src="{{ $logoPath ?? 'https://ui-avatars.com/api/?name=' . urlencode($user->name) }}"
                        alt="Avatar"
                        class="h-10 w-10 rounded-full border-2 border-[#007bff] object-cover"
                    />

                    <!-- Info -->
                    <div class="ml-3 flex-1">
                        <div class="font-semibold">{{ $user->name }}</div>
                        <div class="truncate text-sm text-gray-300">
                            {{ $lastMessage?->message ?? 'No messages yet' }}
                        </div>
                    </div>
                </div>
            @endforeach
        @empty
            <h2 class="pb-4 pl-4">No conversations yet...</h2>
        @endforelse
    </div>

    <!-- 🌊 Bottom logo/button -->
    <div class="flex justify-end p-4">
        <img src="{{ asset('portalEaseLogo.png') }}" alt="portalease" class="h-12 w-12" />
    </div>
</div>
