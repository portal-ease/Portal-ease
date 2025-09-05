<x-app-layout :portal="$portal">
    @if($user != \Illuminate\Support\Facades\Auth::user())
        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 p-6">
            @else
                <div class="max-w-6xl mx-auto grid grid-cols-1 gap-8 p-6">
                    @endif
                    <!-- Profile Panel -->
                    <div class="flex flex-col items-center bg-white rounded-2xl p-6 shadow-md">
                        @php
                            $baseName = $user->name . $user->id;
                            $file = \App\Models\File::whereIn('filename', [
                                $baseName . '.jpg',
                                $baseName . '.png',
                                $baseName . '.jpeg',
                            ])->first();
                        @endphp
                        @if($file)
                            <img src="{{ $file->url }}" alt="{{ $file->filename }}"
                                 class="rounded-full w-32 h-32 object-cover">
                        @else
                            <img src="{{ asset('anonymous_picture.jpg') }}" alt="{{ $user->name }}"
                                 class="rounded-full w-32 h-32 object-cover">
                        @endif
                        <h1 class="text-2xl font-bold mt-4">{{ $user->name }}</h1>
                        <p class="text-sm text-gray-500">{{ $user->email }}</p>
                        @if($user == Auth::user())
                            <a href="{{ route('portal.user.edit', ["portal" => $portal , "user" => $user]) }}"
                               class="bg-blue-500 hover:bg-blue-600 text-white rounded-xl px-5 py-2 text-sm transition">Edit
                                profile</a>
                        @endif
                    </div>
                    @if($user != \Illuminate\Support\Facades\Auth::user())
                        <!-- Chat Panel -->
                        @if(isset($chat))
                            <section class="flex flex-col bg-white rounded-2xl p-6 shadow-md max-h-[600px]">
                                <div class="flex-grow overflow-y-auto space-y-4 pr-2">
                                    @forelse($chat->messages as $message)
                                        <div
                                            class="flex {{ $message->user->id === auth()->id() ? 'justify-end' : 'justify-start' }}">
                                            <div
                                                class="{{ $message->user->id === auth()->id() ? 'bg-blue-100 text-right' : 'bg-gray-100' }} rounded-xl px-4 py-2 max-w-xs text-sm">
                                                <div
                                                    class="font-semibold text-{{ $message->user->id === auth()->id() ? 'blue' : 'gray' }}-700">{{ $message->user->name }}</div>
                                                <div class="text-gray-800">{{ $message->content }}</div>
                                                <div
                                                    class="text-gray-500 text-xs mt-1">{{ $message->created_at->format('H:i') }}</div>
                                            </div>
                                        </div>
                                    @empty
                                        <p class="text-gray-400 italic text-sm text-center">No messages yet. Be the
                                            first to
                                            send
                                            one!</p>
                                    @endforelse
                                </div>

                                <form method="POST"
                                      action="{{ route('portal.chat.message.store', ['portal' => $portal, 'chat' => $chat]) }}"
                                      class="mt-4 flex gap-3">
                                    @csrf
                                    <input type="text" name="content" placeholder="Type a message..."
                                           class="flex-grow bg-gray-100 border border-gray-300 rounded-xl px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-300">
                                    <button type="submit"
                                            class="bg-green-500 hover:bg-green-600 text-white rounded-xl px-5 py-2 text-sm transition">
                                        Send
                                    </button>
                                </form>
                            </section>
                        @endif

                        <!-- Invoices Panel -->
                        <div class="flex flex-col bg-white rounded-2xl p-6 shadow-md">
                            <h2 class="text-2xl font-bold mb-4 text-center">Invoices</h2>
                            <div class="space-y-2">
                                @forelse($user->invoices as $invoice)
                                    <a href="{{ route('portal.invoice.show', ['portal' => $portal, 'invoice' => $invoice]) }}"
                                       class="block hover:bg-gray-100 rounded-2xl p-3 transition">
                                        <div class="font-semibold text-gray-700">{{ $invoice->name }}</div>
                                        <div class="text-red-500 text-xs">{{ $invoice->expiry_date }}</div>
                                    </a>
                                @empty
                                    <p class="text-sm text-gray-400 italic text-center">No invoices shared yet.</p>
                                @endforelse
                            </div>
                        </div>

                        <!-- Shared Files Panel -->
                        <div class="flex flex-col bg-white rounded-2xl p-6 shadow-md">
                            <h2 class="text-2xl font-bold mb-4 text-center">Shared Files</h2>
                            <div class="space-y-2">
                                @forelse($user->files as $file)
                                    <a href="{{ route('portal.file.show', ['portal' => $portal, 'file' => $file]) }}"
                                       class="block hover:bg-gray-100 rounded-2xl p-3 transition">
                                        <div class="font-semibold text-gray-700">{{ $file->filename }}</div>
                                    </a>
                                @empty
                                    <p class="text-sm text-gray-400 italic text-center">No files shared yet.</p>
                                @endforelse
                            </div>
                        </div>
                    @endif
                </div>
</x-app-layout>

