@php use App\Services\FileStorageService; @endphp
<div
    class="flex h-screen w-[62vw] flex-col rounded-xl bg-cover bg-center"
    style="background-image: url('{{ asset('about.png') }}');"
>
    @if ($conversation)
        <!-- 🧑 Header -->
        <div
            class="flex items-center justify-between px-4 py-3 text-white shadow"
            style="background-color: {{ $portal->branding_color }}"
        >
            <div class="flex items-center space-x-3">
                @foreach ($otherUsers as $user)
                    @php
                        $logoPath = app(FileStorageService::class)->userProfilePicture($user);
                    @endphp
                    <img
                        src="{{ $logoPath ?? 'https://ui-avatars.com/api/?name=' . $user->name }}"
                        class="h-10 w-10 rounded-full border-2 border-white"
                        alt="User Avatar"
                    />
                @endforeach
                <div>
                    @foreach ($otherUsers as $user)
                        <div class="text-sm font-semibold">{{ $user->name }} ({{ $user->email }})</div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- 💬 Chat Messages -->
        <div class="flex-1 space-y-4 overflow-y-auto px-4 py-4">
            @foreach ($messages as $message)
                <div class="flex {{ $message->sender_id == auth()->id() ? 'justify-end' : 'justify-start' }}">
                    <div
                        class="
                max-w-[75%]
                px-4 py-2
                rounded-2xl
                shadow-md
                break-words

                {{
                    $message->sender_id == auth()->id()
                    ? 'bg-blue-500 text-white rounded-br-sm'
                    : 'bg-white backdrop-blur text-black rounded-bl-sm'
                }}
            "
                    >
                        <p>{{ $message->message }}</p>

                        <div class="mt-1 text-right text-[10px] opacity-70">
                            {{ $message->created_at->format('H:i') }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="grid grid-cols-[1fr] gap-1">
            <!-- 📨 Message Input -->
            <div
                class="flex items-center space-x-3 rounded-4xl p-10 px-4 py-3"
                style="background-color: {{ $portal->branding_color }}"
            >
                <input
                    wire:model.live="input"
                    type="text"
                    placeholder="Message........"
                    class="flex-1 bg-transparent text-white placeholder-white focus:outline-none"
                />
                <button
                    wire:click="newMessage"
                    class="flex h-12 w-12 items-center justify-center rounded-full bg-white text-gray-800 shadow-lg transition-transform hover:scale-105 hover:cursor-pointer"
                >
                    ➤
                </button>
            </div>
        </div>
    @endif
</div>
