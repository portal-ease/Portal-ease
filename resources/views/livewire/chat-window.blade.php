<div class="flex flex-col h-screen bg-cover bg-center w-[62vw] rounded-xl"
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
                    <div class="font-semibold text-sm">{{ $user->name }} ({{ $user->email }})</div>
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
    <div class="grid grid-cols-[1fr] gap-1">
        <!-- 📨 Message Input -->
        <div class="px-4 py-3 flex items-center space-x-3 rounded-4xl p-10" style="background-color: {{ $portal->branding_color }}">
            <input type="text" placeholder="Message........"
                   class="flex-1 bg-transparent text-white placeholder-white focus:outline-none">

            <div class="flex space-x-3">
                <button class="text-white text-xl"><i class="fa-solid fa-camera"></i></button>
                <button class="text-white text-xl"><i class="fa-solid fa-paperclip"></i></button>
                <button class="text-white text-xl"><i class="fa-solid fa-microphone"></i></button>
            </div>
        </div>
    </div>
        @endif
</div>
