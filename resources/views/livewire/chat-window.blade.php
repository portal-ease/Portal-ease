<div class="flex flex-col h-screen bg-cover bg-center w-[62vw] rounded-xl"
    style="background-image: url('{{ asset('about.png') }}');">
    @if ($conversation)

        <!-- 🧑 Header -->
        <div class="flex items-center justify-between text-white px-4 py-3 shadow"
            style="background-color: {{ $portal->branding_color }}">
            <div class="flex items-center space-x-3">
                @foreach ($otherUsers as $user)
                    <img src="{{ $this->getUserProfilePicture($user) ?? 'https://ui-avatars.com/api/?name=' . $user->name }}"
                        class="h-10 w-10 rounded-full border-2 border-white" alt="User Avatar">
                @endforeach
                <div>
                    @foreach ($otherUsers as $user)
                        <div class="font-semibold text-sm">{{ $user->name }} ({{ $user->email }})</div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- 💬 Chat Messages -->
        <div class="flex-1 overflow-y-auto px-4 py-4 space-y-4">

            @foreach ($messages as $message)
                <div class="flex {{ $message->sender_id == auth()->id() ? 'justify-end' : 'justify-start' }}">

                    <div
                        class="
                max-w-[75%]
                px-4 py-2
                rounded-2xl
                shadow-md
                break-words

                {{ $message->sender_id == auth()->id()
                    ? 'bg-blue-500 text-white rounded-br-sm'
                    : 'bg-white backdrop-blur text-black rounded-bl-sm' }}
            ">
                        <p>{{ $message->message }}</p>

                        <div class="text-[10px] mt-1 opacity-70 text-right">
                            {{ $message->created_at->format('H:i') }}
                        </div>

                    </div>

                </div>
            @endforeach

        </div>
        <div class="grid grid-cols-[1fr] gap-1">
            <!-- 📨 Message Input -->
            <div class="px-4 py-3 flex items-center space-x-3 rounded-4xl p-10"
                style="background-color: {{ $portal->branding_color }}">
                <input wire:model.live="input" type="text" placeholder="Message........"
                    class="flex-1 bg-transparent text-white placeholder-white focus:outline-none">
                <button wire:click="newMessage"
                    class="hover:cursor-pointer flex items-center justify-center w-12 h-12 bg-white text-gray-800 rounded-full hover:scale-105 transition-transform shadow-lg">
                    ➤
                </button>
            </div>
        </div>
    @endif
</div>
