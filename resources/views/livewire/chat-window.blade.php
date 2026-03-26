<div class="flex flex-col h-screen bg-cover bg-center w-[62vw]"
     style="background-image: url('{{ asset('about.png') }}');">
    @if($conversation)

    <!-- 🧑 Header -->
    <div class="flex items-center justify-between text-white px-4 py-3 shadow" style="background-color: {{ $portal->branding_color }}">
        <div class="flex items-center space-x-3">
            @foreach($otherUsers as $user)
                <img src="https://ui-avatars.com/api/?name={{ $user->name }}"
                     class="h-10 w-10 rounded-full border-2 border-white" alt="User Avatar">
            @endforeach
            <div>
                @foreach($otherUsers as $user)
                    <div class="font-semibold text-sm">{{ $user->name }}</div>
                @endforeach
                @if($conversation->type != "group")
                    <div class="text-green-300 text-xs">Online</div>
                @endif
            </div>
        </div>
    </div>

    <!-- 💬 Chat Messages -->
    <div class="flex-1 overflow-y-auto px-4 py-3 space-y-4 text-sm text-white">

    </div>
    <div class="grid grid-cols-[2fr_0.1fr] gap-1">
        <!-- 📨 Message Input -->
        <div class="px-4 py-3 flex items-center space-x-3 rounded-4xl p-10" style="background-color: {{ $portal->branding_color }}">
            <button class="text-white text-2xl">
                <a href="/">&#128512;</a>
            </button>

            <input type="text" placeholder="Message........"
                   class="flex-1 bg-transparent text-white placeholder-white focus:outline-none">

            <div class="flex space-x-3">
                <button class="text-white text-xl"><i class="fa-solid fa-camera"></i></button>
                <button class="text-white text-xl"><i class="fa-solid fa-paperclip"></i></button>
                <button class="text-white text-xl"><i class="fa-solid fa-microphone"></i></button>
            </div>
        </div>
        <div class="px-4 py-3 flex items-center space-x-3 rounded-4xl p-10" style="background-color: {{ $portal->branding_color }}">
            <a class="text-white text-2xl" href="/">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-mic" viewBox="0 0 16 16">
                    <path d="M3.5 6.5A.5.5 0 0 1 4 7v1a4 4 0 0 0 8 0V7a.5.5 0 0 1 1 0v1a5 5 0 0 1-4.5 4.975V15h3a.5.5 0 0 1 0 1h-7a.5.5 0 0 1 0-1h3v-2.025A5 5 0 0 1 3 8V7a.5.5 0 0 1 .5-.5"/>
                    <path d="M10 8a2 2 0 1 1-4 0V3a2 2 0 1 1 4 0zM8 0a3 3 0 0 0-3 3v5a3 3 0 0 0 6 0V3a3 3 0 0 0-3-3"/>
                </svg>
            </a>
        </div>
    </div>
        @endif
</div>
