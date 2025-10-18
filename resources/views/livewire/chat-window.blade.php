<div class="flex flex-col h-screen bg-cover bg-center w-[62vw]"
     style="background-image: url('{{ asset('about.png') }}');">
    @if($conversation)

    <!-- 🧑 Header -->
    <div class="flex items-center justify-between bg-[#33C1FF] text-white px-4 py-3 shadow">
        <div class="flex items-center space-x-3">
            <img src="https://ui-avatars.com/api/?name=Darshan+Zalavadiya"
                 class="h-10 w-10 rounded-full border-2 border-white" alt="User Avatar">
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

    <!-- 📨 Message Input -->
    <div class="bg-[#33C1FF] px-4 py-3 flex items-center space-x-3">
        <button class="text-white text-2xl">
            <i class="fa-regular fa-face-smile"></i>
        </button>

        <input type="text" placeholder="Message........"
               class="flex-1 bg-transparent text-white placeholder-white focus:outline-none">

        <div class="flex space-x-3">
            <button class="text-white text-xl"><i class="fa-solid fa-camera"></i></button>
            <button class="text-white text-xl"><i class="fa-solid fa-paperclip"></i></button>
            <button class="text-white text-xl"><i class="fa-solid fa-microphone"></i></button>
        </div>
    </div>
        @endif
</div>
