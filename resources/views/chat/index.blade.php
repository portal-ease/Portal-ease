<x-app-layout :portal="$portal">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl font-bold">Chats</h2>
        <a href="{{ route('portal.chat.create', $portal) }}"
           class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-xl transition">
            New Chat
        </a>
    </div>

    <div class="flex flex-col gap-4 bg-white p-4 rounded-xl shadow-sm">
        @forelse($portal->chats as $chat)
            <a href="{{ route('portal.chat.show', ['chat' => $chat, 'portal' => $portal]) }}"
               class="flex items-center gap-3 p-3 hover:bg-gray-100 rounded-lg transition">
                @php
                    $baseName = $chat->user1->name . $chat->user1->id;
                    $file = \App\Models\File::whereIn('filename', [
                        $baseName . '.jpg',
                        $baseName . '.png',
                        $baseName . '.jpeg',
                    ])->first();
                @endphp
                @if($file)
                    <img src="{{ $file->url }}" alt="{{ $file->filename }}" class="w-10 h-10 rounded-full object-cover">
                @else
                    <img src="{{ asset('anonymous_picture.jpg') }}" alt="{{ $chat->user1->name }}" class="w-10 h-10 rounded-full object-cover">
                @endif
                <span class="text-blue-500 font-semibold text-base">{{ $chat->user1->name }}</span>
            </a>
        @empty
            <p class="text-gray-500 text-sm italic">No chats available yet.</p>
        @endforelse
    </div>
</x-app-layout>

