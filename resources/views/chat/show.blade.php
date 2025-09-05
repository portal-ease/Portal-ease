<x-app-layout :portal="$portal">
    <div class="flex justify-between items-center mb-6">
        @if(\Illuminate\Support\Facades\Auth::user()->hasRole('service_provider'))
            <h2 class="text-3xl font-bold">Chats</h2>
        @else
            <h2 class="text-3xl font-bold">Chat with: <b class="text-blue-400">{{ $chat->user2->name }}</b></h2>
        @endif
        @if(\Illuminate\Support\Facades\Auth::user()->hasRole('service_provider'))
            <a href="{{ route('portal.chat.create', $portal) }}"
               class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-xl transition">
                New Chat
            </a>
        @endif
    </div>
    @if(\Illuminate\Support\Facades\Auth::user()->hasRole('service_provider'))
        <div class="grid grid-cols-1 lg:grid-cols-[0.4fr_1.6fr] gap-6 h-[32rem]">
            @else
                <div class="grid grid-cols-1 gap-6 h-[32rem]">
                    @endif
                    @if(\Illuminate\Support\Facades\Auth::user()->hasRole('service_provider'))
                        <!-- Sidebar -->
                        <aside class="bg-white p-4 rounded-xl overflow-y-auto shadow-sm">
                            <div class="flex flex-col gap-4">
                                @forelse($portal->chats as $chatItem)
                                    <a href="{{ route('portal.chat.show', ['chat' => $chatItem, 'portal' => $portal]) }}"
                                       class="flex items-center gap-3 p-2 hover:bg-gray-100 rounded-lg transition">
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
                                        <span
                                            class="text-blue-500 font-medium truncate">{{ $chatItem->user1->name }}</span>
                                    </a>
                                @empty
                                    <p class="text-gray-500 text-sm">No chats available.</p>
                                @endforelse
                            </div>
                        </aside>
                    @endif

                    <!-- Chat Panel -->
                    <section class="flex flex-col bg-white rounded-xl p-4 shadow-sm h-full">
                        <div class="flex-grow overflow-y-auto space-y-3 pr-2">
                            @forelse($chat->messages as $message)
                                @if($message->user->id == auth()->id())
                                    <div class="flex justify-end">
                                        <div class="bg-blue-100 rounded-xl px-4 py-2 max-w-xs text-sm text-right">
                                            <div class="font-semibold text-blue-700">{{ $message->user->name }}</div>
                                            <div class="text-gray-800">{{ $message->content }}</div>
                                            <div
                                                class="text-gray-500 text-xs mt-1">{{ $message->created_at->format('H:i') }}</div>
                                        </div>
                                    </div>
                                @else
                                    <div class="flex justify-start">
                                        <div class="bg-gray-100 rounded-xl px-4 py-2 max-w-xs text-sm">
                                            <div class="font-semibold text-gray-700">{{ $message->user->name }}</div>
                                            <div class="text-gray-900">{{ $message->content }}</div>
                                            <div
                                                class="text-gray-500 text-xs mt-1">{{ $message->created_at->format('H:i') }}</div>
                                        </div>
                                    </div>
                                @endif
                            @empty
                                <p class="text-gray-400 italic text-sm">No messages yet. Be the first to send one!</p>
                            @endforelse
                        </div>

                        @if(isset($chat))
                            <form method="POST"
                                  action="{{ route('portal.chat.message.store', ['portal' => $portal, 'chat' => $chat]) }}"
                                  class="mt-4 flex gap-3">
                                @csrf
                                <input type="text" name="content" placeholder="Type a message"
                                       class="flex-grow bg-gray-100 border border-gray-300 rounded-xl px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300">
                                <button type="submit"
                                        class="bg-green-500 hover:bg-green-600 text-white rounded-xl px-5 py-2 text-sm transition">
                                    Send
                                </button>
                            </form>
                        @endif
                    </section>
                </div>
</x-app-layout>


